<?php /* Template Name: Staff Page */
get_header(); ?>

<div class="container staff">
  <section class="head">
    <h1><%= @current_page_info.primary_title %><span> - <small><%= @current_page_info.disclaimer %></small></span></h1>
    <div class="inset-shadow"></div>
    <b></b>
  </section>
  <section class="scrollable-content nano no-mobi">
    <div class="content">
  <% @staffs.each do |staff| -%>
      <div class="col staff">
        <div class="col col1">
  <% @images.each do |staff_image| -%>
  <% if staff_image.parent_id == staff.id -%>
          <div class="static staff">
            <div style="background-image: url('<%= staff_image.image.url(:small) %>');">
              <img src="<%= staff_image.image.url(:small) %>" alt="<%= staff_image.title %>" title="<%= staff_image.title %>" width="202" style="visibility:hidden;">
            </div>
          </div>
  <% end -%>
  <% end -%>
        </div>
        <div class="col col2">
          <h2><strong><%=h staff.name %></strong> - <small><%=h staff.position.upcase %></small></h2>
          <p><%=h staff.description %></p>
        </div>
        <div class="border horizontal"></div>
      </div>
  <% end -%>
      <div class="clearfix"></div>
    </div>
  </section>

  <!-- mobile staff -->
  <section class="scrollable-content mobi">
  <% @staffs.each do |staff| -%>
    <div class="col staff">
      <div class="col col2">
        <h2><strong><%=h staff.name %></strong> - <small><%=h staff.position.upcase %></small></h2>
  <% @images.each do |staff_image| -%>
  <% if staff_image.parent_id == staff.id -%>
        <div class="static mobi">
          <div style="background-image: url('<%= staff_image.image.url(:small) %>');">
            <img src="<%= staff_image.image.url(:small) %>" alt="<%= staff_image.title %>" width="100%">
          </div>
        </div>
  <% end -%>
  <% end -%>
        <p><%=h staff.description %></p>
      </div>
      <div class="border horizontal"></div>
    </div>
  <% end -%>
    <div class="clearfix"></div>
  </section>
</div>

<?php get_footer(); ?>
