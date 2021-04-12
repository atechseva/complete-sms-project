
<footer class="sticky-footer bg-white">
        <div class="container">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Student Management System 2020</span>
          </div>
        </div>
      </footer>
<script src="js/main.js" type="text/javascript"></script>
   <script>
if ($(window).width() > 1) {
  $(window).scroll(function(){  
     if ($(this).scrollTop() > 150) {
        $('#navbar_top').addClass("fixed-top");
        // add padding top to show content behind navbar
        $('body').css('padding-top', $('.navbar').outerHeight() + 'px');
      }else{
        $('#navbar_top').removeClass("fixed-top");
         // remove padding top from body
        $('body').css('padding-top', '0');
      }   
  });
} // end if</script> 

</body>

</html>
<style>
footer.sticky-footer {
    padding: 2rem 0;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    box-shadow: 0 2px 48px 0 rgba(0, 0, 0, 0.2);
    background-image: linear-gradient(315deg, #045de9 0%, #09c6f9 74%);
    color: white;
}
 </style>   