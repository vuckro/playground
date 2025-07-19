<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("profile.php") ) || ( $wpContext->current_url_contains("user-edit.php") ) )) {
		return false;
	}
        ?>
        <script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('your-profile');
  if (!form) return;

  const norm = s => s.normalize('NFD').replace(/[\u0300-\u036f]/g, '').trim().toLowerCase();

  // 1. Collect all direct children and H2s
  const children = Array.from(form.children);
  const allH2s = children.filter(el => el.tagName === 'H2');

  // 2. Find the stop point (Mots de passe d’application)
  const stopIdx = allH2s.findIndex(h2 => norm(h2.textContent) === norm('Mots de passe d’application'));
  const h2s = stopIdx >= 0 ? allH2s.slice(0, stopIdx) : allH2s;

  // 3. Map H2s by label
  const mapH2 = label => h2s.find(h2 => norm(h2.textContent) === norm(label));
  const h2Nom = mapH2('Nom');
  const h2Contact = mapH2('Informations de contact');
  const h2Bio = mapH2('À propos de vous');
  const h2About = mapH2('À propos du compte'); // <-- Ajouté
  const h2Compte = mapH2('Gestion du compte');
  const h2Options = mapH2('Options personnelles');
  const h2Billing = mapH2('Adresse de facturation du client');
  const h2Shipping = mapH2('Adresse de livraison du client');

  // 4. Identify the update button (submit) and keep it aside
  const submitBtn = Array.from(form.querySelectorAll('input[type="submit"], button[type="submit"]')).pop();

  // 5. Build sections (each section: {h2, nodes[]})
  function sectionFrom(h2) {
    if (!h2) return null;
    const nodes = [h2];
    let idx = children.indexOf(h2) + 1;
    while (idx < children.length && children[idx].tagName !== 'H2') {
      if (children[idx] !== submitBtn) nodes.push(children[idx]);
      idx++;
    }
    return { h2, nodes };
  }

  // --- Profil : Nom + Contact + À propos de vous + À propos du compte
  const profilSections = [h2Nom, h2Contact, h2Bio, h2About].map(sectionFrom).filter(Boolean);
  const passSection = sectionFrom(h2Compte);
  const langueSection = sectionFrom(h2Options);
  const billingSection = sectionFrom(h2Billing);
  const shippingSection = sectionFrom(h2Shipping);

  // 6. Collect all already-used H2s
  const usedH2s = new Set([
    h2Nom, h2Contact, h2Bio, h2About, h2Compte, h2Options, h2Billing, h2Shipping
  ].filter(Boolean));

  // 7. Other sections (all H2s not already used, before stopIdx)
  const otherSections = h2s
    .filter(h2 => !usedH2s.has(h2))
    .map(sectionFrom)
    .filter(Boolean);

  // 8. Remove all H2s and their content from DOM (so nothing en double)
  [...profilSections, passSection, langueSection, billingSection, shippingSection, ...otherSections]
    .filter(Boolean)
    .forEach(section => section.nodes.forEach(n => n.remove()));

  // 9. Build panels array in desired order
  const panels = [];

  // Profil
  if (profilSections.length) {
    const panel = document.createElement('div');
    panel.className = 'profile-tab__panel';
    panel.setAttribute('role', 'tabpanel');
    profilSections.forEach(section => section.nodes.forEach(n => panel.appendChild(n)));
    panels.push({ label: 'Profil', panel });
  }

  // Mot de passe
  if (passSection) {
    passSection.h2.textContent = 'Mot de passe';
    const panel = document.createElement('div');
    panel.className = 'profile-tab__panel';
    panel.setAttribute('role', 'tabpanel');
    passSection.nodes.forEach(n => panel.appendChild(n));
    panels.push({ label: 'Mot de passe', panel });
  }

  // Langue
  if (langueSection) {
    langueSection.h2.textContent = 'Langue';
    const panel = document.createElement('div');
    panel.className = 'profile-tab__panel';
    panel.setAttribute('role', 'tabpanel');
    langueSection.nodes.forEach(n => panel.appendChild(n));
    panels.push({ label: 'Langue', panel });
  }

  // Adresse de facturation
  if (billingSection) {
    const panel = document.createElement('div');
    panel.className = 'profile-tab__panel';
    panel.setAttribute('role', 'tabpanel');
    billingSection.nodes.forEach(n => panel.appendChild(n));
    panels.push({ label: 'Adresse de facturation', panel });
  }

  // Adresse de livraison
  if (shippingSection) {
    const panel = document.createElement('div');
    panel.className = 'profile-tab__panel';
    panel.setAttribute('role', 'tabpanel');
    shippingSection.nodes.forEach(n => panel.appendChild(n));
    panels.push({ label: 'Adresse de livraison', panel });
  }

  // Autres
  otherSections.forEach(section => {
    const label = section.h2.textContent.trim();
    const panel = document.createElement('div');
    panel.className = 'profile-tab__panel';
    panel.setAttribute('role', 'tabpanel');
    section.nodes.forEach(n => panel.appendChild(n));
    panels.push({ label, panel });
  });

  // 10. Créer la barre de tabs
  const tabList = document.createElement('div');
  tabList.className = 'profile-tab__list';
  tabList.setAttribute('role', 'tablist');

  panels.forEach(({label, panel}, idx) => {
    panel.id = 'profile-tab-panel-' + idx;
    panel.style.display = idx === 0 ? '' : 'none';
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'profile-tab__tab';
    btn.id = 'profile-tab-' + idx;
    btn.setAttribute('role', 'tab');
    btn.setAttribute('aria-controls', panel.id);
    btn.setAttribute('aria-selected', idx === 0 ? 'true' : 'false');
    btn.tabIndex = idx === 0 ? 0 : -1;
    btn.textContent = label;
    btn.onclick = function () {
      tabList.querySelectorAll('button').forEach((b, j) => {
        b.setAttribute('aria-selected', j === idx ? 'true' : 'false');
        b.tabIndex = j === idx ? 0 : -1;
        panels[j].panel.style.display = j === idx ? '' : 'none';
      });
    };
    tabList.appendChild(btn);
  });

  // 11. Inject in DOM
  form.prepend(tabList);
  panels.forEach(({panel}) => form.appendChild(panel));
  // 12. Remettre le bouton de soumission à la fin (hors tabs)
  if (submitBtn && submitBtn.parentNode !== form) {
    form.appendChild(submitBtn);
  }
});

        </script>

    <?php
    }, 10);

