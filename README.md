FuelPHP-FTP-Module
===================

Using this FTP Module you can manage files and folders by remotely. This module develop using FuelPHP framework.

To setup ftp server IP you need to navigate 

```
"C:\inetpub\wwwroot\FuelPHP-FTP-Manager\fuel\app\modules\FtpFile\classes\controller\FtpFile.php
```

Open the FtpFile.php and change the ftp server Ip 

```
// create an ftp object, but don't connect
        $this->ftp = \Fuel\Core\Ftp::forge(array(
            'hostname' => '192.168.1.3',
            'username' => 'tharanga',
            'password' => '8420',
            'timeout'  => 90,
            'port'     => 21,
            'passive'  => true,
            'ssl_mode' => false,
            'debug'    => false
        ), false);
```
