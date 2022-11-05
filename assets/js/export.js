function saveData() {
    let nomDate = new Date();    
    let nom = name + "_" + nomDate.getFullYear() + "-" + nomDate.getMonth() + "-" + nomDate.getDate() + "_" + nomDate.getHours() + "h" + nomDate.getMinutes() + ".csv";
    let blob = new Blob([export_data], {type: "text/plain;charset=utf-8"});
    saveAs(blob, nom);
}