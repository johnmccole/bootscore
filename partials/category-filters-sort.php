<?php
  $terms = get_terms('category');
?>
<?php if($terms): ?>
<div class="filters position-sticky z-3" style="top: 3.5rem;">
  <div class="ui-group">
    <h3>Category</h3>
    <div class="d-flex">
      <div class="button-group d-flex js-radio-button-group">
        <?php foreach($terms as $term): ?>
        <button class="button text-nowrap me-2" data-filter=".<?= $term->slug ?>"><?= $term->name ?></button>
      <?php endforeach; ?>
      </div>
      <select id="sorts">
        <option value="original-order">Default</option>
        <option value="name">Name</option>
      </select>
    </div>
  </div>
</div>
<?php endif; ?>