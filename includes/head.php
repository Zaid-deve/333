<?php

echo "<!DOCTYPE html>
      <html lang='en'>
      
      <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <title>" . ($pagename ?? $servername) . "</title>
      
          <!-- cdns -->
          <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css' integrity='sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==' crossorigin='anonymous' referrerpolicy='no-referrer' />
      
          <!-- stylesheets -->
          <link rel='stylesheet' href='{$baseurl}styles/config.css'>";
