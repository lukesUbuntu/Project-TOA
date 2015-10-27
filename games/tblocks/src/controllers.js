/**
 * Created by Luke Hardiman on 22/10/2015.
 */
function scoreBoard(){
    var theTemplateScript = $("#example-template").html();

// Compile the template
    var theTemplate = Handlebars.compile(theTemplateScript);

// This is the default context, which is passed to the template
    var context = {
        people: [
            { firstName: 'Homer', lastName: 'Simpson' },
            { firstName: 'Peter', lastName: 'Griffin' },
            { firstName: 'Eric', lastName: 'Cartman' },
            { firstName: 'Kenny', lastName: 'McCormick' },
            { firstName: 'Bart', lastName: 'Simpson' }
        ]
    };

// Pass our data to the template
    var theCompiledHtml = theTemplate(context);

// Add the compiled html to the page
    $(document.body).append(theCompiledHtml);
}
