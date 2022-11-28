function updateButtons(select){
    const btnEnviar = document.getElementById('btnEnviar')
    const btnAtualizar = document.getElementById('btnAtualizar')
    const btnDeletar = document.getElementById('btnDeletar')
    const catpro_Nome = document.getElementById('catpro_Nome')
    const pro_Foto = document.getElementById('pro_Foto')
    const pro_Foto_txt = document.getElementById('pro_Foto_txt')

    if(select.value != ""){
        btnEnviar.disabled = true
        btnAtualizar.disabled = false
        btnDeletar.disabled = false

        preencherCampos(select.value)
    }else{
        btnEnviar.disabled = false
        btnAtualizar.disabled = true
        btnDeletar.disabled = true

        catpro_Nome.value = ""
    }
}

function preencherCampos(id){
    const catpro_foto_txt2 = document.getElementById('pro_Foto_txt')

    let dadosString = document.getElementById('dadosString').innerText
    let dadosArray = []

    dadosString.split('|').forEach(function(dado){
        dadosArray.push(dado.split(';'))
    })

    let reg_selecionado = dadosArray.find(it => it.includes(`catpro_Id:'${id}'`))

    console.log(reg_selecionado)

    catpro_Nome.value = reg_selecionado.find(it => it.split(':')[0] == 'catpro_Nome').split(':')[1].replaceAll("'","")
    catpro_Foto.src = reg_selecionado.find(it => it.split('¬')[0] == 'catpro_Foto').split('¬')[1].replaceAll("'","")
    catpro_foto_txt2.value = reg_selecionado.find(it => it.split('¬')[0] == 'catpro_Foto').split('¬')[1].replaceAll("'","")

}


function onFileInputChange(file){
    const catpro_img = document.getElementById('catpro_img')
    let url = URL.createObjectURL(file)

    catpro_img.src = url
    document.getElementById('catpro_Foto_txt').value = getBase64(file)
}

//Converte o arquivo em BASE64
function getBase64(file) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
        return reader.result
    };
    reader.onerror = function (error) {
      console.log('Error: ', error);
    };
 }