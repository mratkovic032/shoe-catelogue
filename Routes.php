<?php
    return [
        # Admin login/register routes:
        App\Core\Route::get('|^admin/register/?$|',                 'Main',                         'getRegister'),
        App\Core\Route::post('|^admin/register/?$|',                'Main',                         'postRegister'),
        App\Core\Route::get('|^admin/login/?$|',                    'Main',                         'getLogin'),
        App\Core\Route::post('|^admin/login/?$|',                   'Main',                         'postLogin'),        

        # Guest role routes:
        App\Core\Route::get('|^category/([0-9]+/?)$|',              'Category',                     'show'),
        App\Core\Route::get('|^product/([0-9]+/?)$|',               'Product',                      'show'),        

        # Admin role routes:
            App\Core\Route::get('|^admin/dashboard/?$|',                'AdminDashboard',               'index'),
            App\Core\Route::get('|^admin/categories/?$|',               'AdminProductMenagement',       'categories'),
            App\Core\Route::get('|^admin/brands/?$|',                   'AdminProductMenagement',       'brands'),        
            App\Core\Route::get('|^admin/products/?$|',                 'AdminProductMenagement',       'products'),
            App\Core\Route::get('|^admin/colors/?$|',                   'AdminProductMenagement',       'colors'),
            App\Core\Route::get('|^admin/sizes/?$|',                    'AdminProductMenagement',       'sizes'),

            # Products        
            App\Core\Route::get('|^admin/products/edit/([0-9]+)/?$|',           'AdminProductMenagement',       'getProductEdit'),
            App\Core\Route::post('|^admin/products/edit/([0-9]+)/?$|',          'AdminProductMenagement',       'postProductEdit'),
            App\Core\Route::get('|^admin/products/add/?$|',                     'AdminProductMenagement',       'getProductAdd'),
            App\Core\Route::post('|^admin/products/add/?$|',                    'AdminProductMenagement',       'postProductAdd'),        

            # Product Version
            App\Core\Route::get('|^admin/products/stock/([0-9]+)/?$|',          'AdminProductMenagement',       'stock'),
            App\Core\Route::get('|^admin/products/stock/add/([0-9]+)/?$|',      'AdminProductMenagement',       'getStockAdd'),
            App\Core\Route::post('|^admin/products/stock/add/([0-9]+)/?$|',     'AdminProductMenagement',       'postStockAdd'),
            App\Core\Route::get('|^admin/products/stock/edit/([0-9]+)/?$|',     'AdminProductMenagement',       'getStockEdit'),
            App\Core\Route::post('|^admin/products/stock/edit/([0-9]+)/?$|',    'AdminProductMenagement',       'postStockEdit'),

            # Categories
            App\Core\Route::get('|^admin/categories/edit/([0-9]+)/?$|',   'AdminProductMenagement',       'getCategoryEdit'),
            App\Core\Route::post('|^admin/categories/edit/([0-9]+)/?$|',  'AdminProductMenagement',       'postCategoryEdit'),
            App\Core\Route::get('|^admin/categories/add/?$|',             'AdminProductMenagement',       'getCategoryAdd'),
            App\Core\Route::post('|^admin/categories/add/?$|',            'AdminProductMenagement',       'postCategoryAdd'),

            # Brands
            App\Core\Route::get('|^admin/brands/edit/([0-9]+)/?$|',   'AdminProductMenagement',       'getBrandEdit'),
            App\Core\Route::post('|^admin/brands/edit/([0-9]+)/?$|',  'AdminProductMenagement',       'postBrandEdit'),
            App\Core\Route::get('|^admin/brands/add/?$|',             'AdminProductMenagement',       'getBrandAdd'),
            App\Core\Route::post('|^admin/brands/add/?$|',            'AdminProductMenagement',       'postBrandAdd'),

            # Colors
            App\Core\Route::get('|^admin/colors/edit/([0-9]+)/?$|',   'AdminProductMenagement',       'getColorEdit'),
            App\Core\Route::post('|^admin/colors/edit/([0-9]+)/?$|',  'AdminProductMenagement',       'postColorEdit'),
            App\Core\Route::get('|^admin/colors/add/?$|',             'AdminProductMenagement',       'getColorAdd'),
            App\Core\Route::post('|^admin/colors/add/?$|',            'AdminProductMenagement',       'postColorAdd'),

            # Sizes
            App\Core\Route::get('|^admin/sizes/edit/([0-9]+)/?$|',   'AdminProductMenagement',       'getSizeEdit'),
            App\Core\Route::post('|^admin/sizes/edit/([0-9]+)/?$|',  'AdminProductMenagement',       'postSizeEdit'),
            App\Core\Route::get('|^admin/sizes/add/?$|',             'AdminProductMenagement',       'getSizeAdd'),
            App\Core\Route::post('|^admin/sizes/add/?$|',            'AdminProductMenagement',       'postSizeAdd'),

        # API routes:

            # Bookmarks:
            App\Core\Route::get('|^api/product/([0-9]+)/?$|',           'ApiProduct',                   'show'),
            App\Core\Route::get('|^api/bookmarks/?$|',                  'ApiBookmark',                  'getBookmarks'),
            App\Core\Route::get('|^api/bookmarks/add/([0-9]+)/?$|',     'ApiBookmark',                  'addBookmark'),
            App\Core\Route::get('|^api/bookmarks/clear/?$|',            'ApiBookmark',                  'clear'),

            # Color:
            App\Core\Route::get('|^api/color/?$|',                       'ApiColor',                  'getColors'),
            App\Core\Route::get('|^api/color/add/([A-Z][a-z]+)/?$|',     'ApiColor',                  'addColor'),

            # Size:
            App\Core\Route::get('|^api/size/?$|',                       'ApiSize',                  'getSizes'),
            App\Core\Route::get('|^api/size/add/([0-9]+)/?$|',          'ApiSize',                  'addSize'),

        App\Core\Route::any('|^.*$|',                               'Main',                         'home')
    ];