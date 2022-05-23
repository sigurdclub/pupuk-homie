<?php
session_start();
session_unset();//utk memastikan sesion dihapus
session_destroy();//menghapus sesion
header('Location:http://localhost/stock_barang/index.php');