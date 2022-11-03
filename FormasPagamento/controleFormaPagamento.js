function updateButtons(select) {
    const btnEnviar = document.getElementById('btnEnviar')
    const btnAtualizar = document.getElementById('btnAtualizar')
    const btnDeletar = document.getElementById('btnDeletar')
    const fp_Nome = document.getElementById('fp_Nome')
    const fp_Parcelavel_1 = document.getElementById('fp_Parcelavel_1')
    const fp_Parcelavel_0 = document.getElementById('fp_Parcelavel_0')

    if (select.value != "") {
        btnEnviar.disabled = true
        btnAtualizar.disabled = false
        btnDeletar.disabled = false

        preencherCampos(select.value)
    } else {
        btnEnviar.disabled = false
        btnAtualizar.disabled = true
        btnDeletar.disabled = true

        fp_Nome.value = ""
        fp_Parcelavel_1.checked = false
        fp_Parcelavel_0.checked = true
    }
}

function preencherCampos(id){
    let dadosString = document.getElementById('dadosString').innerText
    let dadosArray = []

    dadosString.split('/').forEach(function(dado){
        dadosArray.push(dado.split(';'))
    })

    let reg_selecionado = dadosArray.find(it => it.includes(`fp_Id:'${id}'`))

    console.log(reg_selecionado)

    fp_Nome.value = reg_selecionado.find(it => it.split(':')[0] == 'fp_Nome').split(':')[1].replaceAll("'","")
    let fp_Parcelavel_value = reg_selecionado.find(it => it.split(':')[0] == 'fp_Parcelavel').split(':')[1].replaceAll("'","")
    
    if(fp_Parcelavel_value == 1){
        fp_Parcelavel_0.checked = false
        fp_Parcelavel_1.checked = true
    }else{
        fp_Parcelavel_0.checked = true
        fp_Parcelavel_1.checked = false
    }
}