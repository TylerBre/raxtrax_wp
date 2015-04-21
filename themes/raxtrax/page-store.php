<?php /* Template Name: Store Page */
get_header(); ?>

<div class="container store">
  <section class="head">
    <h1><%= @current_page_info.primary_title %><span> - <small><%= @current_page_info.secondary_title %></small></span></h1></h1>
    <div class="inset-shadow"></div>
    <b></b>
  </section>
  <section class="scrollable-content nano no-mobi">
    <div class="content">
  <% @products.each do |product| -%>
      <div class="col store">
        <div class="col col1">
        <% @images.each do |product_image| -%>
        <% if product_image.parent_id == product.id -%>
          <div class="static store">
            <div style="background-image: url('<%= product_image.image.url(:original) %>');">
              <img src="<%= product_image.image.url(:original) %>" alt="<%= product_image.title %>" title="<%= product_image.title %>" style="visibility: hidden;" width="378">
            </div>
          </div>
        <% end -%>
        <% end -%>
        </div>
        <div class="col col2">
          <div class="descriptions">
            <h2><%= product.name -%></h2>
            <h3><%= product.description -%></h3>
          </div>
          <div class="actions">
            <% form_tag line_items_path(:product_id => product) do -%>
            <div class="left">
              <div>
                <p>Price (USD):</p>
                <h3><%= number_to_currency(product.price) -%></h3>
              </div>
              <div class="last">
                <p>Quantity:</p>
                <input id="quantity" name="quantity" maxlength="2" size="1" type="text" value="1">
              </div>
            </div>
            <div class="right">
                <%= submit_tag "Add to cart", :class => "poo" %>
            </div>
            <% end -%>
          </div>
        </div>
        <div class="border horizontal"></div>
      </div>
  <% end -%>
      <div class="clearfix"></div>
    </div>
  </section>
  <!-- FOR MOBILE OUTPUT -->
  <%= render :partial => 'mobile_store', :locals => { :products => @products, :images => @images } -%>
</div>
<?php get_footer(); ?>
