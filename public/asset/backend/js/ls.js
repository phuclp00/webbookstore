ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error => {
        console.error(error);
    });
showlist_thumb = function() {
    var input = document.getElementById('thump');
    var output = document.getElementById('fileList');
    output.innerHTML = '<ul>';
    for (var i = 0; i < input.files.length; ++i) {
        output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
    }
    output.innerHTML += '</ul>';
}
showname_file = function() {
    var la = document.getElementById('picture');
    var ot = document.getElementById('file_name');
    ot.innerHTML = '<ul>';
    ot.innerHTML += '<li>' + la.files.item(0).name + '</li>';
    ot.innerHTML += '</ul>';
}