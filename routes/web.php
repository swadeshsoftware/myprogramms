<?php
Route::group(array('namespace'=>'Front', 'middleware' => 'web'), function(){
	Route::get('/',
	array('as' => 'home',
		'uses' => 'HomeController@index'
	));
	Route::post('/check-subscribe-email',
	array('as' => 'check-subscribe-email',
		'uses' => 'HomeController@CheckSubscribeEmail'
	));
	Route::post('/subcribes',
	array('as' => 'subscribes',
		'uses' => 'HomeController@Subscribes'
	));
	Route::get('/service/{alias}',
	array('as' => 'service/alias',
		'uses' => 'ServicesController@index'
	));
	Route::get('/why-choose-us/{alias}',
	array('as' => 'why-choose-us-alias',
		'uses' => 'WhyChooseUsController@index'
	));
	Route::get('/testimonials',
	array('as' => 'testimonials',
		'uses' => 'TestimonialsController@index'
	));
	Route::get('/about-us',
	array('as' => 'about-us',
		'uses' => 'CommonController@AboutUs'
	));
	Route::get('/terms-and-condition',
	array('as' => 'terms-and-condition',
		'uses' => 'CommonController@TermsAndCondition'
	));
	Route::get('/faq',
	array('as' => 'faq',
		'uses' => 'CommonController@FAQ'
	));
	Route::get('/privacy-policy',
	array('as' => 'privacy-policy',
		'uses' => 'CommonController@PrivacyPolicy'
	));
	Route::get('/blogs',
	array('as' => 'blogs',
		'uses' => 'BlogController@index'
	));
	Route::get('/blog/{alias}',
	array('as' => 'blog-alias',
		'uses' => 'BlogController@BlogDetails'
	));
	Route::get('/contact-us', 
    array('as' => 'contact-us',
        'uses' => 'ContactUsController@ContactUs'
    ));
    Route::post('/contact-send', 
    array('as' => 'contact-send',
        'uses' => 'ContactUsController@ContactSend'
    ));
});

Route::group(['middleware' => 'web'], function(){
	Route::get('/admin/register', 
	array('as' => 'admin-register',
		'uses' => 'AdminAuth\RegisterController@showRegistrationForm'
	));
	Route::post('/admin/register', 
	array('as' => 'admin-register',
		'uses' => 'AdminAuth\RegisterController@register'
	));
	Route::get('/admin/login', 
	array('as' => 'admin-login',
		'uses' => 'AdminAuth\LoginController@showLoginForm'
	));
	Route::get('/admin', 
	array('as' => 'admin',
		'uses' => 'AdminAuth\LoginController@showLoginForm'
	));
	Route::post('/admin/login', 
	array('as' => 'login',
		'uses' => 'AdminAuth\LoginController@login'
	));
	Route::get('admin_password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
    Route::post('admin_password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('admin_password/reset/{token}', 'AdminAuth\ForgotPasswordController@showResetForm');
    Route::post('admin_password/reset-pass', 'AdminAuth\ForgotPasswordController@postResetPassword');
});
Route::group(array('namespace'=>'AdminAuth', 'middleware' => 'auth','admin'), function(){
	Route::post('/admin/logout', 
	array('as' => 'admin-logout',
		'uses' => 'LoginController@logout'
	));
});
Route::prefix('admin')->group(function () {
	Route::group(array('namespace'=>'Admin', 'middleware' => 'auth','admin'), function(){
		Route::resource('dashboards', 'DashboardsController');
		Route::resource('signup', 'AdministratorController');
		Route::post('signup-update-status',[
	        'as' => 'signup-update-status',
	        'uses' => 'AdministratorController@update_status'
        ]);
        Route::resource('profile', 'ProfileController');  
        Route::get('change-password', 'ProfileController@change_password');
        Route::post('save-password', 'ProfileController@save_password');
        Route::resource('settings', 'SiteSettingsController');
        Route::resource('banners', 'BannerController');
        Route::post('banners-update-status',[
        	'as' => 'banners-update-status',
        	'uses' => 'BannerController@update_status'
        ]);
		Route::resource('testimonals', 'TestimonialController');
		Route::post('testimonals-update-status',[
			'as' => 'testimonals-update-status',
			'uses' => 'TestimonialController@update_status'
		]);
		Route::resource('pages', 'PageController');
    	Route::post('pages-update-status',[
	        'as' => 'pages-update-status',
	        'uses' => 'PageController@update_status'
        ]);
        Route::resource('supports', 'SupportController');
    	Route::post('support-update-status',[
	        'as' => 'support-update-status',
	        'uses' => 'SupportController@update_status'
        ]);
        Route::resource('why-choose-us', 'WhyChooseUsController');
        Route::resource('subscribes','SubscribeController');
		Route::get('/send-subscribe-mail-modal',[
			'as' => 'send-subscribe-mail-modal',
			'uses' => 'SubscribeController@SendSubscribeMailModal'
		]);
		Route::post('/sendemail',[
			'as' => 'sendemail',
			'uses' => 'SubscribeController@SendMail'
		]);
		Route::post('subscribe-multiple-delete',[
            'as' => 'subscribe-multiple-delete',
            'uses' => 'SubscribeController@multiple_destroy'
        ]);
        Route::get('/send-bulk-mail-modal',[
			'as' => 'send-bulk-mail-modal',
			'uses' => 'SubscribeController@SendBulkMailModal'
		]);
        Route::post('bulk-send-mail',[
            'as' => 'bulk-send-mail',
            'uses' => 'SubscribeController@BulkSendMail'
        ]);
        Route::resource('blogs','BlogController');
        Route::post('/blog-update-status',[
	        'as' => 'blog-update-status',
	        'uses' => 'BlogController@update_status'
        ]);
        Route::post('/blogs-multiple-delete',[
	        'as' => 'blogs-multiple-delete',
	        'uses' => 'BlogController@multiple_destory'
        ]);
        Route::resource('services','ServiceController');
        Route::post('/service-update-status',[
	        'as' => 'service-update-status',
	        'uses' => 'ServiceController@update_status'
        ]);
	});
});
