function ClickOnRow(){
var rows = document.getElementsByTagName("tr");
    for (var i = 0; i < rows.length; i++)
    {
        rows[i].onclick = function()
        {
            console.log(this);
        };
    }
}