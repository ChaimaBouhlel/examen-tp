function highlight(){
    let table = document.getElementById('table-etudiant');
    for (let i=0;i < table.rows.length;i++) {
        table.rows[i].onclick = function () {
            this.classList.toggle('highlight')
        }
    }
}
highlight();
