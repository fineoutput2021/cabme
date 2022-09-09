<!DOCTYPE html>
<html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <!-- Css file include -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Tiara Tag</title>
</head>

<body style="padding-top:14rem;">
  <div class="container main_container">
    <div class="row justify-content-center">
      <!-- <div class="col-sm-4"></div> -->
      <?
                  $this->db->select('*');
      $this->db->from('tbl_colour');
      $this->db->where('id',$type_data->colour_id);
      $color_data= $this->db->get()->row();
      ?>
      <div class="col-sm-4 text-center p-0" style="max-height:90px;max-width:90px" id="html-content-holder">
        <h6 style="margin-bottom:0.5px;font-size:7px;"><?=$p_name?></h6>
        <ul style="list-style: none;padding:0px;font-size:5px; margin-bottom:0.5px">
          <li><b>Type Code :</b> <?=$type_data->t_code?></li>
          <li><b>Color :</b> <?=$color_data->colour_name?></li>
          <!-- <li><b>Size :</b> <?=$type_data->name?></li> -->
          <li><b>MRP :</b><span style="font-size:8px"> ₹<?=$type_data->retailer_mrp?></span></li>
        </ul>
        <img src="<?=base_url().$type_data->barcode_tag_image?>"style="width:75%;height:40%"/>
        <p style="font-size:5px;"><b>Customer Care:</b><br />tiara@gmail.com</p>
      </div>
      <!-- <div class="col-sm-4"></div> -->
      <input type="hidden" name="name" id="name" value="<?=$p_name?>-<?=$type_data->t_code?>">
      <div class="col-md-12 text-center mt-5">
         <a id="btn_convert1" href="javascript:void(0)"><button class="btn btn-primary" style="background-color:#ff9b98;border:none">Download</button></a>
</div>
    </div><br>

  </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url()?>assets/html2canvas.js" type="text/javascript"></script>
<script>
    document.getElementById("btn_convert1").addEventListener("click", function() {
 html2canvas(document.getElementById("html-content-holder")).then(function (canvas) {var anchorTag = document.createElement("a");
     document.body.appendChild(anchorTag);
     var name  = $('#name').val();
     anchorTag.download = name+".jpg";
     anchorTag.href = canvas.toDataURL();
     anchorTag.target = '_blank';
     anchorTag.click();
     // window.history.back()
   });
});
</script>

</html>
