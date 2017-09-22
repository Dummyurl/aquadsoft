<html>
<head></head>
<body>

<form action="<?php echo base_url('Webservice/get_all_url_by_business_api');   ?>"  method="post" >

    <h1>Url is :  <?php echo base_url('Webservice/get_all_url_by_business_api'); ?> </h1>
    This is Post api
    Enter the business type id <input type="text " name="id" >
    <input type="submit" value="Result">

</form>


</body>
</html>