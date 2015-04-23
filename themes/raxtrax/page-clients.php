<?php /* Template Name: Clients Page */
get_header(); ?>

<div class="container clients">
  <div class="col col1 split no-mobi">
    <section class="head">
      <h1><span><%= @current_page_info.secondary_title %></span></h1>
      <div class="inset-shadow"></div>
      <b></b>
    </section>
    <section class="scrollable-content nano">
      <div class="content">
        <table style="margin-top: 15px;">
<% @clients.each do |client| -%>
<% unless client.website.nil? -%>
          <tr>
            <td><a href="http://<%= client.website %>" target="_blank"><%= client.name %></a></td>
          </tr>
<% else -%>
          <tr>
            <td><%= client.name %></td>
          </tr>
<% end -%>
<% end -%>
        </table>
      </div>
    </section>
  </div>

  <div class="border vertical no-mobi"></div>

  <div class="col col2 split no-mobi">
    <section class="head">
      <h1><%= @current_page_info.primary_title %></h1>
      <div class="inset-shadow"></div>
      <b></b>
    </section>
    <section class="scrollable-content nano">
      <div class="content">
        <article>
          <section class="client-gallery">
            <div id="slider1" class="multiple">
<% @images.each do |image| -%>
              <div style="background-image: url('<%= image.image.url(:small) %>');">
                <img src="<%= image.image.url(:small) %>" width="145" style="visibility:hidden;" />
              </div>
<% end -%>
            </div>
          </section>
          <section class="client-featured-container">
<% @clients.each_with_index do |client, index| -%>
<% if client.important? -%>
<% if client.website.match(/(http:\/\/)/) -%>
          <a href="<%= client.website %>" target="_blank" class="featured-client link"><%= client.name %></a><span class="comma">,&nbsp;</span>
<% elsif client.website.match(/([.])/) -%>
          <a href="http://<%= client.website %>" target="_blank" class="featured-client link"><%= client.name %></a><span class="comma">,&nbsp;</span>
<% else -%>
          <span class="featured-client"><%= client.name %></span><span class="comma">,&nbsp;</span>
<% end -%>
<% end -%>
<% end -%>
          </section>
        </article>
      </div>
    </section>
  </div>

  <!-- mobile clients -->

  <div class="col mobi">
    <section class="head">
      <h1><%= @current_page_info.primary_title %></h1>
      <div class="inset-shadow"></div>
      <b></b>
    </section>
    <section class="scrollable-content">
  <!-- LIST -->
  <% odd_even_split(@clients) -%>
      <div class="list-column left">
        <table>
  <% @even.each do |client| -%>
  <% unless client.website.nil? -%>
          <tr>
            <td><a href="http://<%= client.website %>" target="_blank"><%= client.name %></a></td>
          </tr>
  <% else -%>
          <tr>
            <td><%= client.name %></td>
          </tr>
  <% end -%>
  <% end -%>
        </table>
      </div>
      <div class="list-column right">
        <table>
  <% @odd.each do |client| -%>
  <% unless client.website.nil? -%>
          <tr>
            <td><a href="http://<%= client.website %>" target="_blank"><%= client.name %></a></td>
          </tr>
  <% else -%>
          <tr>
            <td><%= client.name %></td>
          </tr>
  <% end -%>
  <% end -%>
        </table>
      </div>
    </section>
  </div>


  <div class="clearfix"></div>
</div>
<script src="/javascripts/plugins/easing1.3.js" type="text/javascript"></script>
<script src="/javascripts/plugins/image-slider.js" type="text/javascript"></script>
<script type="text/javascript">
  $('.head .inset-shadow').css('opacity', '0');
  $('.scrollable-content .content').scroll(function() {
    scrollContentInsets(this);
  });
  $('.comma:last-child').remove();
  $('.content img:last-child').load(function() {
    $('.nano').nanoScroller();
  });
  $('.nano').nanoScroller();
  // $(document).ready(function() {
    $('#slider1').bxSlider({
      startingSlide: 0,
      pager: false,
      auto: false,
      autoControls: true,
      displaySlideQty: 3,
      moveSlideQty: 1,
      randomStart: true
    });
  // });
</script>


<?php get_footer(); ?>
