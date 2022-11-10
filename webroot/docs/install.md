### Installation procedure of Clcknshop Multitenant E-Commerce platform

#### Server Requirements
**Before you install  make sure your server meets the following requirements:**
- PHP 7.x
- MySQL 5.6+ or MariaDB 10.0+
- Intl PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- PHP GD Extension



#### Please follow the instructions below to install the php script.
- Step 1: Unzip the downloaded project zip  to your web hosting folder.\
Say example `/var/www/html/clcknshop `

- Step 2: Run composer update Command from shell(Optional).\
COMMAND `composer update`

- Step 3: Change permission some folders like tmp , logs etc.\
COMMAND 
```bash
chmod -R 0777 tmp logs webroot/contents webroot/themestore
```

- Step 4: Open phpmyadmin or any other mysql management panel to create a database say example `clcknshop`

- Step 5: Import database script from `config/schema/clcknshop.sql` 

- Step 6: Open config file `config/clcnshop.php`

- Step 7: Change clcknshop config strings as follows

```php
define('ADMIN_DOMAIN','clckn.shop'); 
#Put your main domain name here in place of clckn.shop.

define('BASE_DB_NAME','clcknshop'); 
#Change clcnshop with your  database name here.

define('DATABASE_URL', 'mysql://clcknshop:clcknshop@localhost/' . BASE_DB_NAME); 
#Change database username:password here clcnshop:clcknshop. 
#Make sure the mysql user has permission to create database with prefix of your base db name.
#As example if your base db name is clcknshop, then the user should have permission to create database clcknshop_any-store-name.
#Change database hostname in place of localhost.

define('RECAPTCHA_SITE_KEY','6Ldc95IiAAAAALsUnD2Fj7KS0pGncI1L0LI7RlRv');
define('RECAPTCHA_SECRET_KEY','6Ldc95IiAAAAAPsLY7xEFRMIW1GV3x_B9sPnh8x-');
#Put recptcha site key and secret to use use captch in your site.
#But if you don't want to setup recaptcha just comment above two lines (RECAPTCHA_SITE_KEY and RECAPTCHA_SECRET_KEY) by putting // or # 
```
#### Make some changes in server configuration file.

- **For apache see configurations below**

```html
<VirtualHost 209.127.124.3:80>
	    ServerAdmin webmaster@dummy-host.example.com
	    DocumentRoot /var/www/html/clcnknshop/webroot
	    ServerName clcnknshop.com
	    ServerAlias *.clcnknshop.com
	    IncludeOptional /var/www/html/clcnknshop/tmp/cache/domains.apache.conf
	    RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
	</VirtualHost>


   <IfModule mod_ssl.c>
	<VirtualHost 209.127.124.3:443>
	    ServerAdmin webmaster@dummy-host.example.com
	    DocumentRoot /var/www/html/clcnknshop/webroot
	    ServerName clcnknshop.com
	    ServerAlias *.clcnknshop.com
	    IncludeOptional /var/www/html/clcnknshop/tmp/cache/domains.apache.conf
	   
	    <Directory "/var/www/html/clcknshop/webroot">
	        AllowOverride All
	        Require all granted
	    </Directory>	    
	SSLCertificateFile /etc/ssl/certs/clcknshop.com/cert.pem
	SSLCertificateKeyFile /etc/ssl/certs/clcknshop.com/privkey.pem
	</VirtualHost>
	</IfModule>
```

- **For Nginx see configurations below**

```html
server {
        #Replace all of domain by your domain won domain name.
	    server_name  *.clckn.shop clckn.shop www.clckn.shop;

	    include /var/www/html/clcknshop/tmp/cache/domains.nginx.conf;

        
	    root   /var/www/html/clcknshop/webroot; #put your project webroot path.
	    index index.php index.html index.htm;

	   
	    
	    location / {
	        index  index.php index.html;

	        # If the file exists as a static file serve it 
	        # directly without running all
	        # the other rewite tests on it
	        if (-f $request_filename) { 
	            break; 
	        }
	        if (!-f $request_filename) {
	            rewrite ^/(.+)$ /index.php?url=$1 last;
	            break;
	        }
	    }
	    error_page 404 /404.html;
	    error_page 500 502 503 504 /50x.html;

	    location = /50x.html {
	        root /usr/share/nginx/html;
	    }

	    location ~ \.php$ {
	        try_files $uri =404;
	        fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
	        fastcgi_index index.php;
	        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
	        include /etc/nginx/fastcgi_params;
	        fastcgi_param SERVER_NAME $host;
	        
	        #include fastcgi_params;
	    }
	   

	    listen 209.127.124.5:443 ssl; # managed by Certbot
	    ssl_certificate /etc/ssl/certs/clcknshop.com/cert.pem
	    ssl_certificate_key /etc/ssl/certs/clcknshop.com/privkey.pem
	}server {
	   
	    server_name  *.clckn.shop clckn.shop www.clckn.shop; #put your own damain name.
	    include /var/www/html/clcknshop/tmp/cache/domains.nginx.conf;

	    listen 209.127.124.5:80; #Replace by your server IP:Port
	    return 302 https://$server_name$request_uri;

	}

```


SSL certificate should be same for your primary ip and its subdomains. Eg. clckn.shop www.clckn.shop *.clckn.shop should have same SSL certificate.

The additional domain configure will be loaded from file
`/var/www/html/clcnknshop/tmp/cache/domains.apache.conf`
`/var/www/html/clcnknshop/tmp/cache/domains.nginx.conf`

this files need include only when your certificate is self signed and you are using a CDN provider like cloudflare for SSL .
If you have different ssl files for other domains then all configuration need to be done separtely for addition domains.
Also a manual restart of the webserver is needed after adding a new domain.

- **DNS Settings** 
Make sure your to set same ip same for the domain with asterisk mark. Eg. clckn.shop www.clckn.shop *.clckn.shop all should be pointed to same IP. 


- **Additional configuration**
Additional configuration needed for advance users. For default email , pdf , sms settings change file app_local.php
For any advance configuration instruction please email us for support instructions.

- **Lunch the site and login to admin panel**
After all setup site can be browse. Admin login will be https://DOMAIN/admin . Eg. https://clckn.shop/admin \
Default username : admin@clckn.shop \
Default passsword: 123456 