/*function passwordEnable()
{
  if(document.getElementById('oui').checked == true)
  {
    document.getElementById('password_enable').style.display = "none";
  }
  else if (document.getElementById('non').checked == true)
  {
    document.getElementById('password_enable').style.display = "block";
  }
}*/

function passwordEnable()
{
  if(document.getElementById('non').checked == true)
  {
    document.getElementById('disabledInput').disabled = false;
  }
  else if (document.getElementById('oui').checked == true)
  {
    document.getElementById('disabledInput').disabled = true;
  }
}

function deleteDevice()
{
  if(confirm("Voulez-vous vraiment supprimer ?"))
  {
    delete_device.submit();
  }
}

function addDevice()
{
  alert("ajouté");
}


/*if(document.location.protocol == "http:")
{
  document.location.href = "https://"+document.location.host+document.location.pathname;
}*/
