function passwordEnable()
{
  if(document.getElementById('oui').checked == true)
  {
    document.getElementById('password_enable').style.display = "none";
  }
  else if (document.getElementById('non').checked == true)
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

function changeHostname()
{
  width = 300;
  height = 200;
  if(window.innerWidth)
  {
  var left = (window.innerWidth-width)/2;
  var top = (window.innerHeight-height)/2;
  }
  else
  {
  var left = (document.body.clientWidth-width)/2;
  var top = (document.body.clientHeight-height)/2;
  }
  window.open('change_hostname.html','Hostname','menubar=no, scrollbars=no, top='+top+', left='+left+', width='+width+', height='+height+'');
}
