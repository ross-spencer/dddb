dddb
====

.htaccess
----------

RewriteEngine on
RewriteBase /

RewriteRule ^id/(.+)$ doc/$1 [R=303]
RewriteRule ^doc/(.+)$ dddb/public/index.php

RewriteCond %{REQUEST_URI} !^/id/(.+)$
RewriteCond %{REQUEST_URI} !^/doc/(.+)$
RewriteRule !\.(js|ico|txt|gif|jpg|png|css)$ dddb/public/index.php

php_flag magic_quotes_gpc off

