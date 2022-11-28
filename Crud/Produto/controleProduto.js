function updateButtons(select) {
    const btnEnviar = document.getElementById('btnEnviar')
    const btnAtualizar = document.getElementById('btnAtualizar')
    const btnDeletar = document.getElementById('btnDeletar')
    const pro_Id_Categoria = document.getElementById('pro_Id_Categoria')
    const pro_Nome = document.getElementById('pro_Nome')
    const pro_Preco = document.getElementById('pro_Preco')
    const pro_Detalhe = document.getElementById('pro_Detalhe')
    const pro_Foto = document.getElementById('pro_Foto')
    const pro_img = document.getElementById('pro_img')
    const pro_Foto_txt = document.getElementById('pro_Foto_txt')

    if (select.value != "") {
        btnEnviar.disabled = true
        btnAtualizar.disabled = false
        btnDeletar.disabled = false

        preencherCampos(select.value)
    } else {
        btnEnviar.disabled = false
        btnAtualizar.disabled = true
        btnDeletar.disabled = true

        pro_Id_Categoria.value = 1
        pro_Nome.value = ""
        pro_Preco.value = ""
        pro_Detalhe.value = ""
        pro_Foto.type = "text"
        pro_Foto.type = "file"
        pro_img.src = ""
        pro_Foto_txt.value = ""
    }
}

function preencherCampos(id){
    const pro_foto_txt2 = document.getElementById('pro_Foto_txt')

    let dadosString = document.getElementById('dadosString').innerText
    let dadosArray = []
    const pro_Nome = document.getElementById('pro_Nome')
    const pro_Preco = document.getElementById('pro_Preco')
    const pro_Id_Categoria = document.getElementById('pro_Id_Categoria') 
    const pro_Detalhe = document.getElementById('pro_Detalhe') 

    dadosString.split('|').forEach(function(dado){
        dadosArray.push(dado.split('§'))
    })

    let reg_selecionado = dadosArray.find(it => it.includes(`pro_Id:'${id}'`))

    console.log(reg_selecionado)

    pro_Nome.value = reg_selecionado.find(it => it.split('¬')[0] == 'pro_Nome').split('¬')[1].replaceAll("'","")
    pro_Preco.value = reg_selecionado.find(it => it.split('¬')[0] == 'pro_Preco').split('¬')[1].replaceAll("'","")
    pro_Id_Categoria.value = reg_selecionado.find(it => it.split('¬')[0] == 'pro_Id_Categoria').split('¬')[1].replaceAll("'","")
    pro_Detalhe.value = reg_selecionado.find(it => it.split('¬')[0] == 'pro_Detalhe').split('¬')[1].replaceAll("'","")
    pro_Foto.src = reg_selecionado.find(it => it.split('¬')[0] == 'pro_Foto').split('¬')[1].replaceAll("'","")
    pro_foto_txt2.value = reg_selecionado.find(it => it.split('¬')[0] == 'pro_Foto').split('¬')[1].replaceAll("'","")
}

//CARREGA IMAGE PARA SER MOSTRADA E MANDA ELA PARA SER GERADO SEU BASE64
function onFileInputChange(file){
    const pro_img = document.getElementById('pro_img')
    let url = URL.createObjectURL(file)

    pro_img.src = url
    document.getElementById('pro_Foto_txt').value = getBase64(file)
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