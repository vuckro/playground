<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("options-permalink.php") ) )) {
		return false;
	}
        ?>
        <script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('form[action="options-permalink.php"]');
  if (!form) return;

  const normalize = str =>
    str.normalize('NFD').replace(/[\u0300-\u036f]/g, '').trim().toLowerCase();

  const children = Array.from(form.children);
  const h2s = children.filter(el => el.tagName === 'H2');
  const submitBtn = form.querySelector('p.submit');

  function sectionFrom(h2) {
    const nodes = [h2];
    let idx = children.indexOf(h2) + 1;
    while (idx < children.length && children[idx].tagName !== 'H2') {
      if (children[idx] !== submitBtn) nodes.push(children[idx]);
      idx++;
    }
    return { h2, nodes };
  }

  const labels = {
    'Réglages les plus courants': 'Structure',
    'Facultatif': 'Préfixes',
    'Permaliens de produit': 'Produits',
  };

  const sections = h2s
    .map(h2 => {
      const label = labels[h2.textContent.trim()] || h2.textContent.trim();
      return { label, ...sectionFrom(h2) };
    })
    .filter(Boolean);

  sections.forEach(section => section.nodes.forEach(n => n.remove()));

  // Créer la barre d'onglets
  const tabList = document.createElement('div');
  tabList.className = 'profile-tab__list';
  tabList.setAttribute('role', 'tablist');

  const panels = sections.map(({ label, nodes }, idx) => {
    const panel = document.createElement('div');
    panel.className = 'profile-tab__panel';
    panel.id = 'permalink-tab-panel-' + idx;
    panel.style.display = idx === 0 ? '' : 'none';
    panel.setAttribute('role', 'tabpanel');
    nodes.forEach(n => panel.appendChild(n));

    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'profile-tab__tab';
    btn.id = 'permalink-tab-' + idx;
    btn.setAttribute('role', 'tab');
    btn.setAttribute('aria-controls', panel.id);
    btn.setAttribute('aria-selected', idx === 0 ? 'true' : 'false');
    btn.tabIndex = idx === 0 ? 0 : -1;
    btn.textContent = label;
    btn.onclick = () => {
      tabList.querySelectorAll('button').forEach((b, j) => {
        b.setAttribute('aria-selected', j === idx ? 'true' : 'false');
        b.tabIndex = j === idx ? 0 : -1;
        panels[j].style.display = j === idx ? '' : 'none';
      });
    };
    tabList.appendChild(btn);

    return panel;
  });

  form.prepend(tabList);
  panels.forEach(p => form.insertBefore(p, submitBtn));
});

        </script>

    <?php
    }, 10);

