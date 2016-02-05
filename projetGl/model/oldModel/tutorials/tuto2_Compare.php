<h2><a href="#">Why do you compare value</a></h2>
Compare two values is the idea to know if the <strong>content</strong> of two variables (<strong>the value of the varible</strong> not the name) are the same. If it's not the case it's to know if the first or the second value are the <strong>biggest</strong>. The compare is the first state of an other struture of data name <strong>the condition if</strong>. The condition will make the code make something <strong>only if</strong> a condition is good. For example to buy alcool you need to be 18 year old. So we <strong>compare</strong> your age to 18. If your age is bigger or equals it's fine in the other case you can't buy alcool.
<h2><a href="#">In Python</a></h2>
It is similar to that of <strong>other languages</strong>. The if statement contains a <strong>logical expression</strong>(boolean: true or false) using which data is compared and a decision is made based on <strong>the result</strong> of the comparison.
<ul>
    <li>if expression:<br /><span class="tabulation">statement(s)</span></li>
</ul>
If the boolean expression evaluates to TRUE, then the block of statement(s) <strong>inside the if statement is executed</strong>. If boolean expression evaluates to FALSE, then the first set of code after the end of the if statement(s) is executed.
<img src="./view/img/if_statement.jpg"/>
Example of code (in Python):<br />
age = 10<br />
if (age >= 18) :<br />
<span class="tabulation">print "you can buy alcool"</span><br />
The example show how you do to check is someone can buy alcool or not. You just need to change the content (<strong>value</strong>) of the variable name age. It could also be use to find the <strong>minimal</strong> value between three of them. Just compare all of them with each other. Like that you can find the <strong>biggest or the smallest</strong> one.<br />
<h2><a href="#">Graphic interface</a></h2>
To compare two values in graphic interface you need to use the element in <strong>yellow</strong> (who, look like a <strong>scales</strong>). Select him with the arrow and <strong>drag and drop</strong> the component on the board.
<img src="./view/img/scales.jpg"/>
To use the scales you need to have <strong>two variables to compare</strong>. It's importante to compare the <strong>same type</strong> of variable. A string can't be bigger to a number because the value are not in <strong>the same format</strong>. It's the same with the boolean and a number. If you don't remember how to create a variable or wath, is a type go back to the <a href="?action=7&idTuto=tuto0_Variable">variable's tutorial</a>.
<img src="./view/img/usedScales.jpg"/>
You can also use the scale to test a <strong>boolean condition</strong>. To do that we use the <strong>right clic</strong> on the scales to change the test. The scales will become <strong>green or red</strong> if the condition is <strong>true or false</strong>. They are three possible test:
<ul>
    <li>the left is smalest to the right</li>
    <li>the left is equals to the right smalest</li>
    <li>the left is bigger to the right</li>
</ul>
<h2><a href="#">Exemple of test</a></h2>
I will remake the same problem with the age of 18 years old to buy. Here is what, we need to make the test:
<img src="./view/img/ageNeeded.jpg"/>
We need to <strong>set</strong> the scales to select the good test. If the age is bigger than the needed age is true (become green) in other case is false (we can buy alcool and it become red). So we select the <strong>third setting</strong> (click three time with the right click on the scales).
<img src="./view/img/alcoolTestWrong.jpg"/>
Now we remake the same test with the same setting on scales but we will test with an ago of 23.
<img src="./view/img/alcoolTestWright.jpg"/>
This time we can buy alcool. Because the test is true.
