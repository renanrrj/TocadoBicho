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
    const catpro_Nome = document.getElementById('catpro_Nome')

    dadosString.split('/').forEach(function(dado){
        dadosArray.push(dado.split(';'))
    })

    let reg_selecionado = dadosArray.find(it => it.includes(`catpro_Id:'${id}'`))

    console.log(reg_selecionado)

    catpro_Nome.value = reg_selecionado.find(it => it.split(':')[0] == 'catpro_Nome').split(':')[1].replaceAll("'","")
}