function updateButtons(select){
    const btnEnviar = document.getElementById('btnEnviar')
    const btnAtualizar = document.getElementById('btnAtualizar')
    const btnDeletar = document.getElementById('btnDeletar')
    const ani_Nome = document.getElementById('ani_Nome')
    const ani_Raca = document.getElementById('ani_Raca')
    const ani_Peso = document.getElementById('ani_Peso')
    const ani_Altura = document.getElementById('ani_Altura')
    const ani_Endereco = document.getElementById('ani_Endereco')
    const ani_Idade = document.getElementById('ani_Idade')
    const ani_Especie = document.getElementById('ani_Especie')
    const animal_img = document.getElementById('animal_img')

    if(select.value != ""){
        btnEnviar.disabled = true
        btnAtualizar.disabled = false
        btnDeletar.disabled = false

        preencherCampos(select.value)
    }else{
        btnEnviar.disabled = false
        btnAtualizar.disabled = true
        btnDeletar.disabled = true

        ani_Nome.value = "" 
        ani_Raca.value = "" 
        ani_Peso.value = "" 
        ani_Altura.value = "" 
        ani_Endereco.value = "" 
        ani_Idade.value = "" 
        ani_Especie.value = ""
        animal_img.src = ""
    }
}

function preencherCampos(id){
    let dadosString = document.getElementById('dadosString').innerText
    let dadosArray = []

    dadosString.split('|').forEach(function(dado){
        dadosArray.push(dado.split('§'))
    })

    let reg_selecionado = dadosArray.find(it => it.includes(`ani_Id¬'${id}'`))

    console.log(reg_selecionado)

    ani_Nome.value = reg_selecionado.find(it => it.split('¬')[0] == 'ani_Nome').split('¬')[1].replaceAll("'","")
    ani_Raca.value = reg_selecionado.find(it => it.split('¬')[0] == 'ani_Raca').split('¬')[1].replaceAll("'","")
    ani_Peso.value = reg_selecionado.find(it => it.split('¬')[0] == 'ani_Peso').split('¬')[1].replaceAll("'","")
    ani_Altura.value = reg_selecionado.find(it => it.split('¬')[0] == 'ani_Altura').split('¬')[1].replaceAll("'","")
    ani_Endereco.value = reg_selecionado.find(it => it.split('¬')[0] == 'ani_Endereco').split('¬')[1].replaceAll("'","")
    ani_Idade.value = reg_selecionado.find(it => it.split('¬')[0] == 'ani_Idade').split('¬')[1].replaceAll("'","")
    ani_Especie.value = reg_selecionado.find(it => it.split('¬')[0] == 'ani_Especie').split('¬')[1].replaceAll("'","")
    animal_img.src = reg_selecionado.find(it => it.split('¬')[0] == 'ani_Foto').split('¬')[1].replaceAll("'","")


}

//Converte o arquivo em BASE64
function getBase64(file) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
        document.getElementById('ani_Foto_txt').value = reader.result//.split('base64,')[1];
    };
    reader.onerror = function (error) {
      console.log('Error: ', error);
    };
 }