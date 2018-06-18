<?php
    return [
        # Admin login/register routes:
        # App\Core\Route::get('|^admin/register/?$|',                 'Main',                         'getRegister'),
        # App\Core\Route::post('|^admin/register/?$|',                'Main',                         'postRegister'),
        App\Core\Route::get('|^admin/login/?$|',                    'Main',                         'getLogin'),
        App\Core\Route::post('|^admin/login/?$|',                   'Main',                         'postLogin'),        

        # Guest role routes:
        App\Core\Route::get('|^category/([0-9]+/?)$|',              'Category',                     'show'),
        App\Core\Route::get('|^product/([0-9]+/?)$|',               'Product',                      'show'),        

        # Admin role routes:
            App\Core\Route::get('|^admin/dashboard/?$|',                        'AdminDashboard',               'index'),                                          

            # Products        
            App\Core\Route::get('|^admin/products/?$|',                         'AdminProductMenagement',       'products'),
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
            App\Core\Route::get('|^admin/categories/?$|',                       'AdminCategoryMenagement',       'categories'),
            App\Core\Route::get('|^admin/categories/edit/([0-9]+)/?$|',         'AdminCategoryMenagement',       'getCategoryEdit'),
            App\Core\Route::post('|^admin/categories/edit/([0-9]+)/?$|',        'AdminCategoryMenagement',       'postCategoryEdit'),
            App\Core\Route::get('|^admin/categories/add/?$|',                   'AdminCategoryMenagement',       'getCategoryAdd'),
            App\Core\Route::post('|^admin/categories/add/?$|',                  'AdminCategoryMenagement',       'postCategoryAdd'),

            # Brands
            App\Core\Route::get('|^admin/brands/?$|',                           'AdminBrandMenagement',       'brands'),  
            App\Core\Route::get('|^admin/brands/edit/([0-9]+)/?$|',             'AdminBrandMenagement',       'getBrandEdit'),
            App\Core\Route::post('|^admin/brands/edit/([0-9]+)/?$|',            'AdminBrandMenagement',       'postBrandEdit'),
            App\Core\Route::get('|^admin/brands/add/?$|',                       'AdminBrandMenagement',       'getBrandAdd'),
            App\Core\Route::post('|^admin/brands/add/?$|',                      'AdminBrandMenagement',       'postBrandAdd'),

            # Colors
            App\Core\Route::get('|^admin/colors/?$|',                           'AdminColorMenagement',       'colors'),
            App\Core\Route::get('|^admin/colors/edit/([0-9]+)/?$|',             'AdminColorMenagement',       'getColorEdit'),
            App\Core\Route::post('|^admin/colors/edit/([0-9]+)/?$|',            'AdminColorMenagement',       'postColorEdit'),
            App\Core\Route::get('|^admin/colors/add/?$|',                       'AdminColorMenagement',       'getColorAdd'),
            App\Core\Route::post('|^admin/colors/add/?$|',                      'AdminColorMenagement',       'postColorAdd'),

            # Sizes
            App\Core\Route::get('|^admin/sizes/?$|',                            'AdminSizeMenagement',       'sizes'),
            App\Core\Route::get('|^admin/sizes/edit/([0-9]+)/?$|',              'AdminSizeMenagement',       'getSizeEdit'),
            App\Core\Route::post('|^admin/sizes/edit/([0-9]+)/?$|',             'AdminSizeMenagement',       'postSizeEdit'),
            App\Core\Route::get('|^admin/sizes/add/?$|',                        'AdminSizeMenagement',       'getSizeAdd'),
            App\Core\Route::post('|^admin/sizes/add/?$|',                       'AdminSizeMenagement',       'postSizeAdd'),

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

        # Search:
        App\Core\Route::post('|^search/?$|',                             'Search',                  'quickSearch'),

        App\Core\Route::any('|^.*$|',                               'Main',                         'home')
    ];