<?php

function luv_acp_page_html() { ?>
<div class="wrap">
  <header class="title">
    <h1>LINK UP Vendors</h1>
    <p>v1.0.0</p>
  </header>
  <section class="tutorial">
    <h2>How to use the plugin:</h2>
    <div class="tutorial__instr">
      <h3>Shortcode</h3>
      <p>Place the shortcode <code>[vendors]</code> on your page or post. This will display a list of vendors, ordered alphabetically and separated by category.</p>
      <p><img style="max-width: 80%" src="<?php echo plugin_dir_url( __DIR__ ) . '/media/Add_shortcode.png' ?>" alt="Adding shortcode to Divi page builder" /></p>
    </div>
    <div class="tutorial__instr">
      <h3>Add new vendor</h3>
      <ol>
        <li>Click on &quot;Vendors&quot; in the admin panel.</li>
        <li>Click on &quot;Add New Vendor&quot;.</li>
      </ol>
      <p><img style="max-width: 80%" src="<?php echo plugin_dir_url( __DIR__ ) . '/media/Add_new_vendor.png' ?>" alt="Add new vendor from Wordpress admin" /></p>
    </div>
    <div class="tutorial__instr">
      <h3>Vendor category</h3>
      <p>When creating a vendor, you can create and select a vendor category on the right side of the page. Note that the vendor will not appear unless it is assigned a category.</p>
      <p><img style="max-width: 80%" src="<?php echo plugin_dir_url( __DIR__ ) . '/media/Create_select_vendor_category.png' ?>" alt="Vendor category panel" /></p>
    </div>
    <div class="tutorial__instr">
      <h3>Featured image</h3>
      <p>Upload the vendor image in the featured image panel.</p>
      <p><img style="max-width: 80%" src="<?php echo plugin_dir_url( __DIR__ ) . '/media/Vendor_image.png' ?>" alt="Featured image panel" /></p>
    </div>
    <div class="tutorial__instr">
      <h3>Preview information</h3>
      <p>Add information about the vendor in the preview information boxes. This information will appear next to the vendor's featured image in the vendor list.</p>
      <p><img style="max-width: 80%" src="<?php echo plugin_dir_url( __DIR__ ) . '/media/Preview_information.png' ?>" alt="Preview information panel" /></p>
      <p><img style="max-width: 80%" src="<?php echo plugin_dir_url( __DIR__ ) . '/media/Vendor_card.png' ?>" alt="Vendor card" /></p>
    </div>
    <div class="tutorial__instr">
      <h3>Vendor page</h3>
      <p>A vendor specific page can be built using the page builder (Divi) or the default page editor.</p>
      <p><img style="max-width: 80%" src="<?php echo plugin_dir_url( __DIR__ ) . '/media/Vendor_name.png' ?>" alt="Featured image panel" /></p>
    </div>
  </section>
  <aside class="dev-info">
    <h2>Developer information</h2>
    <p>Hi there! My name is Anneta and <a href="https://annetawamono.github.io/portfolio/">I'm a web designer and developer</a>. You can find the repository for this plugin on <a href="https://github.com/annetawamono/linkup-vendor-plugin">Github</a>. If you have any feedback or questions about the plugin, you can email them to me at <a href="mailto:dev@annetawamono.co.za">dev@annetawamono.co.za</a></p>
  </aside>
</div><?php
} ?>
