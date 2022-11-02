function updateButtons(select){
    const btnEnviar = document.getElementById('btnEnviar')
    const btnAtualizar = document.getElementById('btnAtualizar')
    const btnDeletar = document.getElementById('btnDeletar')

    if(select.value != ""){
        btnEnviar.disabled = true
        btnAtualizar.disabled = false
        btnDeletar.disabled = false

        preencherCampos(select.value)
    }else{
        btnEnviar.disabled = false
        btnAtualizar.disabled = true
        btnDeletar.disabled = true
    }
}

function preencherCampos(id){
    let dadosString = document.getElementById('dadosString').innerText
    let dadosArray = []
    const ani_Nome = document.getElementById('ani_Nome')
    const ani_Raca = document.getElementById('ani_Raca')
    const ani_Peso = document.getElementById('ani_Peso')
    const ani_Altura = document.getElementById('ani_Altura')
    const ani_Endereco = document.getElementById('ani_Endereco')
    const ani_Idade = document.getElementById('ani_Idade')

    dadosString.split('/').forEach(function(dado){
        dadosArray.push(dado.split(';'))
    })

    let reg_selecionado = dadosArray.find(it => it.includes(`ani_Id:'${id}'`))

    console.log(reg_selecionado)

    ani_Nome.value = reg_selecionado.find(it => it.split(':')[0] == 'ani_Nome').split(':')[1].replaceAll("'","")
    ani_Raca.value = reg_selecionado.find(it => it.split(':')[0] == 'ani_Raca').split(':')[1].replaceAll("'","")
    ani_Peso.value = reg_selecionado.find(it => it.split(':')[0] == 'ani_Peso').split(':')[1].replaceAll("'","")
    ani_Altura.value = reg_selecionado.find(it => it.split(':')[0] == 'ani_Altura').split(':')[1].replaceAll("'","")
    ani_Endereco.value = reg_selecionado.find(it => it.split(':')[0] == 'ani_Endereco').split(':')[1].replaceAll("'","")
    ani_Idade.value = reg_selecionado.find(it => it.split(':')[0] == 'ani_Idade').split(':')[1].replaceAll("'","")
}