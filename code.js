function passwordEnable()
{
  if(document.getElementById('oui').checked == true)
  {
    document.getElementById('password_enable').style.display = "none";
  }else if (document.getElementById('non').checked == true)
  {
    document.getElementById('password_enable').style.display = "block";
  }
}

function deleteDevice()
{
  if(confirm("Voulez-vous vraiment supprimer ?"))
  {
    delete_device.submit();
  }
}
