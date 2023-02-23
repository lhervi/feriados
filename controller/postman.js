

var formdata = new FormData();
formdata.append("mensaje", "segundo mensaje");
formdata.append("fecha", "2023-02-22");

var requestOptions = {
  method: 'POST',
  body: formdata,
  redirect: 'follow'
};

fetch("http://10.150.11.96:9012/view/respuestaTest.php", requestOptions)
  .then(response => response.text())
  .then(result => console.log(result))
  .catch(error => console.log('error', error));