function dispbill()
{

   document.getElementById('o-div2').style.display="block";

}
function showreview(arg)
{
    select_value= arg.value;
    document.getElementById('item_name').innerHTML= select_value;
    document.getElementById('hname').value=select_value;
    document.getElementById('reviewdiv').style.display="block";
   window.scrollBy(1000,2000);
}
document.querySelector('#can_btn').onclick = () =>{
   document.querySelector('.updatepsec').style.display = 'none';
   window.location.href = 'admin_products.php';

}