/**************  Admin login *********************/
$("#adminloginFrom").validate( {
    rules: {
        email: {
            required: true,
        }
        , password: {
            required: true
        }
    }
    , messages: {
        email: {
            required: "Enter your email",
        }
        , password: {
            required: "Enter your password"
        }
    }
    , errorPlacement: function(error, element) {
        if (element.attr("name")=="email") {
            error.insertAfter("#admin-email");
        }
        else if (element.attr("name")=="password") {
            error.insertAfter("#admin-password");
        }
        else {
            error.insertAfter(element);
        }
    }
});




   //  tinymce.init({
   //  selector: '.tinymce',
   //  height: 300,
   //  theme: 'modern',
   //   extended_valid_elements: "span",
   //  plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak',
   //  'searchreplace wordcount visualblocks visualchars code fullscreen',
   //  'insertdatetime media nonbreaking save table contextmenu directionality',
   //  'emoticons template paste textcolor colorpicker textpattern imagetools'
   //  ],
   // toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
   // toolbar2: 'print preview media | forecolor backcolor emoticons',
   // image_advtab: true,
   // templates: [
   // { title: 'Test template 1', content: 'Test 1' },
   // { title: 'Test template 2', content: 'Test 2' }
   // ],
   // content_css: ['//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
   //  '//www.tinymce.com/css/codepen.min.css'
   // ]
   // });

   tinymce.init({
  selector: '.tinymce',
  height: 150,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });


	var select2 = $('[data-toggle="select"]');
	select2.length && select2.each(function() {
			$(this).select2();
	});
	var select2_nosearch = $('[data-toggle="select_nosearch"]');
	select2_nosearch.length && select2_nosearch.each(function() {
			$(this).select2({
				minimumResultsForSearch: -1
			});
	});

$('[data-toggle="tooltip"]').tooltip();