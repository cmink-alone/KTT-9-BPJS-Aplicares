<?php

include('config/koneksi.php');

if ($_GET[view]==''){
 
  include "page/awal.php";

}
elseif ($_GET[view]=='index'){
 
  include "page/awal.php";

}
elseif ($_GET[view]=='dashboard'){
 
  include "page/ruangan/dashboard.php";

} 
elseif ($_GET[view]=='entriruangan'){

  include "page/ruangan/entri-ruangan.php";
}
elseif ($_GET[view]=='listruangan'){

  include "page/ruangan/list-ruangan.php";
}
elseif ($_GET[view]=='updateruangan'){

  include "page/update/update-ruangan.php";
}
elseif ($_GET[view]=='runningtext'){

  include "page/running/update-runningtext.php";
}
elseif ($_GET[view]=='contact'){

  include "page/contact/set-contact.php";
}
elseif ($_GET[view]=='hapusruangan'){

  include "page/ruangan/hapus-ruangan.php";
}
elseif ($_GET[view]=='sinkron'){

  include "page/sinkron/sinkron-data.php";
}
// Apabila modul tidak ditemukan
else{

  include "page/404.php";

}


?>
