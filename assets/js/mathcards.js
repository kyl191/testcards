function validate(attempt){
    if (answer == attempt){
        correct++;
    }
    questionsLeft--;
    $('input[type=radio]').prop('disabled', true);
    if (correct >= 10  || questionsLeft <= 0){
        $("#endbutton").show();
        $("#nextbutton").hide();
    } else {
        $('#nextbutton').show();
    }
}

function clearAnswers(){
    $('input[type=radio]').prop('disabled', false);
    $('input[type=radio]:checked').prop('checked', false);
}

function nextQuestion(data){
    clearAnswers();
    nextQn = data.pop();
    $("#question").fadeIn('fast').html(nextQn.question);
    $("#label1").fadeIn('fast').html(nextQn.label1);
    $("#label2").fadeIn('fast').html(nextQn.label2);
    $("#label3").fadeIn('fast').html(nextQn.label3);
    reason = nextQn.reason;
    answer = nextQn.answer;
    // http://docs.mathjax.org/en/latest/typeset.html
    MathJax.Hub.Queue(["Typeset",MathJax.Hub, "mainleft"]);
    MathJax.Hub.Queue(["Typeset",MathJax.Hub, "mainright"]);
}

function showSummary(){
    $("#restartbutton").before("<h2 id=\"message\">Congrats!</h2> <p>You got " + correct + " questions correct!</p>").fadeIn("fast");
    $("#mainleft").fadeOut("fast");
    $("#mainright").fadeOut("fast");
    $("#restartbutton").show();
}
var questions;
function init(){
    getData(function(data){
    
        data = fisherYates(data);
        // Fade everything back in
        $("#mainright").fadeIn("fast");
        $("#mainleft").fadeIn("fast");
        $('label').fadeIn();
        $('input[type=radio]').fadeIn();
        
        // Clean up, assume we're restarting
        $("#message").remove();
        $("#main > p").remove();
        correct = 0;
        numQuestions = data.length;
        questionsLeft = data.length - 1;

        // Hide all the buttons
        $('#nextbutton').hide();
        $('#restartbutton').hide();
        $('#endbutton').hide();

        // Get the next question
        nextQuestion(data);
        questions = data;
        });
    
}

function fisherYates ( myArray ) {
    // from http://sedition.com/perl/javascript-fy.html
    var i = myArray.length;
    if ( i == 0 ) return false;
    while ( --i ) {
        var j = Math.floor( Math.random() * ( i + 1 ) );
        var tempi = myArray[i];
        var tempj = myArray[j];
        myArray[i] = tempj;
        myArray[j] = tempi;
    }
    return myArray;
}


function getData(callback){
    // jQuery ajax request to /cards/generate_set/id

    var data = $.ajax({
        dataType: "json",
        url: "/cards/generate_set/"+test_id,
        data: data,
        success: function(data){
            console.log("Retrived id " + test_id + " successfully");
            console.log(data);
            var items = [];
            $.each(data, function(key, val) {
                items.push(val);
            });
            console.log(items.length);
            console.log(items);
            callback(items);}
        });
}

var answer, reason, correct, numQuestions, questionsLeft;
correct = 0;
numQuestions = 0;
questionsLeft = 0;
