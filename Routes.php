<?php
    return [
        # Admin login/register routes:
        # App\Core\Route::get('|^admin/register/?$|',                 'Main',                         'getRegister'),
        # App\Core\Route::post('|^admin/register/?$|',                'Main',                         'postRegister'),
        App\Core\Route::get('|^admin/login/?$|',                    'Main',                         'getLogin'),
        App\Core\Route::post('|^admin/login/?$|',                   'Main',                         'postLogin'),
        App\Core\Route::get('|^admin/logout/?$|',                   'Main',                         'getLogout'),        

        # Guest role routes:
        App\Core\Route::get('|^category/([0-9]+/?)$|',                  'Category',                     'show'),
        App\Core\Route::get('|^products/?$|',                           'Product',                      'products'),
        App\Core\Route::get('|^product/([0-9]+/?)$|',                   'Product',                      'show'),
        App\Core\Route::get('|^category/([0-9]+)/brand/([0-9]+/?)$|',   'Brand',                        'show'),
        App\Core\Route::get('|^brand/([0-9]+/?)$|',                     'Brand',                        'brandProducts'),
        App\Core\Route::get('|^brands/?$|',                             'Brand',                        'brands'),    

        # Admin role routes:
            App\Core\Route::get('|^admin/dashboard/?$|',                        'AdminDashboard',               'index'),
            App\Core\Route::get('|^admin/profile/?$|',                          'AdminDashboard',               'profile'),

            # Products        
            App\Core\Route::get('|^admin/products/?$|',                         'AdminProductManagement',       'products'),
            App\Core\Route::get('|^admin/products/edit/([0-9]+)/?$|',           'AdminProductManagement',       'getProductEdit'),
            App\Core\Route::post('|^admin/products/edit/([0-9]+)/?$|',          'AdminProductManagement',       'postProductEdit'),
            App\Core\Route::get('|^admin/products/add/?$|',                     'AdminProductManagement',       'getProductAdd'),
            App\Core\Route::post('|^admin/products/add/?$|',                    'AdminProductManagement',       'postProductAdd'),        

            # Product Version
            App\Core\Route::get('|^admin/products/stock/([0-9]+)/?$|',                  'AdminProductManagement',       'stock'),
            App\Core\Route::get('|^admin/products/stock/([0-9]+)/delete/([0-9]+)/?$|',  'AdminProductManagement',       'deleteStock'),  
            App\Core\Route::get('|^admin/products/stock/add/([0-9]+)/?$|',              'AdminProductManagement',       'getStockAdd'),
            App\Core\Route::post('|^admin/products/stock/add/([0-9]+)/?$|',             'AdminProductManagement',       'postStockAdd'),
            App\Core\Route::get('|^admin/products/stock/edit/([0-9]+)/?$|',             'AdminProductManagement',       'getStockEdit'),
            App\Core\Route::post('|^admin/products/stock/edit/([0-9]+)/?$|',            'AdminProductManagement',       'postStockEdit'),

            # Categories
            App\Core\Route::get('|^admin/categories/?$|',                       'AdminCategoryManagement',       'categories'),
            App\Core\Route::get('|^admin/categories/delete/([0-9]+)/?$|',       'AdminCategoryManagement',       'delete'),
            App\Core\Route::get('|^admin/categories/edit/([0-9]+)/?$|',         'AdminCategoryManagement',       'getEdit'),
            App\Core\Route::post('|^admin/categories/edit/([0-9]+)/?$|',        'AdminCategoryManagement',       'postEdit'),
            App\Core\Route::get('|^admin/categories/add/?$|',                   'AdminCategoryManagement',       'getAdd'),
            App\Core\Route::post('|^admin/categories/add/?$|',                  'AdminCategoryManagement',       'postAdd'),

            # Brands
            App\Core\Route::get('|^admin/brands/?$|',                           'AdminBrandManagement',       'brands'),
            App\Core\Route::get('|^admin/brands/delete/([0-9]+)/?$|',           'AdminBrandManagement',       'delete'),  
            App\Core\Route::get('|^admin/brands/edit/([0-9]+)/?$|',             'AdminBrandManagement',       'getEdit'),
            App\Core\Route::post('|^admin/brands/edit/([0-9]+)/?$|',            'AdminBrandManagement',       'postEdit'),
            App\Core\Route::get('|^admin/brands/add/?$|',                       'AdminBrandManagement',       'getAdd'),
            App\Core\Route::post('|^admin/brands/add/?$|',                      'AdminBrandManagement',       'postAdd'),

            # Colors
            App\Core\Route::get('|^admin/colors/?$|',                           'AdminColorManagement',       'colors'),
            App\Core\Route::get('|^admin/colors/delete/([0-9]+)/?$|',           'AdminColorManagement',       'delete'),
            App\Core\Route::get('|^admin/colors/edit/([0-9]+)/?$|',             'AdminColorManagement',       'getEdit'),
            App\Core\Route::post('|^admin/colors/edit/([0-9]+)/?$|',            'AdminColorManagement',       'postEdit'),
            App\Core\Route::get('|^admin/colors/add/?$|',                       'AdminColorManagement',       'getAdd'),
            App\Core\Route::post('|^admin/colors/add/?$|',                      'AdminColorManagement',       'postAdd'),

            # Sizes
            App\Core\Route::get('|^admin/sizes/?$|',                            'AdminSizeManagement',       'sizes'),
            App\Core\Route::get('|^admin/sizes/delete/([0-9]+)/?$|',            'AdminSizeManagement',       'delete'),
            App\Core\Route::get('|^admin/sizes/edit/([0-9]+)/?$|',              'AdminSizeManagement',       'getEdit'),
            App\Core\Route::post('|^admin/sizes/edit/([0-9]+)/?$|',             'AdminSizeManagement',       'postEdit'),
            App\Core\Route::get('|^admin/sizes/add/?$|',                        'AdminSizeManagement',       'getAdd'),
            App\Core\Route::post('|^admin/sizes/add/?$|',                       'AdminSizeManagement',       'postAdd'),

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
            App\Core\Route::get('|^api/size/?$|',                        'ApiSize',                  'getSizes'),
            App\Core\Route::get('|^api/size/add/([0-9]+)/?$|',           'ApiSize',                  'addSize'),

            # Category:
            App\Core\Route::get('|^api/category/?$|',                     'ApiCategory',           'getCategories'),
            App\Core\Route::get('|^api/category/add/([A-Z][a-z]+)/?$|',   'ApiCategory',           'addCategory'),

            # Brand:
            App\Core\Route::get('|^api/brand/?$|',                        'ApiBrand',                 'getBrands'),
            App\Core\Route::get('|^api/brand/add/([A-Z][a-z]+)/?$|',      'ApiBrand',                 'addBrand'),

        # Search:
        App\Core\Route::post('|^search/?$|',                             'Search',                  'quickSearch'),

        App\Core\Route::any('|^.*$|',                               'Main',                         'home')
    ];