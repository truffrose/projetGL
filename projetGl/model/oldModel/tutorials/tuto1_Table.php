<h2><a href="#">What is a table?</a></h2>
A table (also call array or list in Python) is one of the most <strong>basic data structure</strong>. Each element of the table is assigned a number. This number will be the position also call <strong>the index</strong> of the elements. The first index of a table is <strong>0</strong>. After that the next is one, two, ... It could be compare to a box who <strong>contains many variables</strong>. The table will also containt a symbolic <strong>name</strong>. So to access to an element you need to know the name of the table and the position of the element inside this table.
<br />
<h2><a href="#">What it's look like in the code</a></h2>
<ul>
    <li>
        <h3>Python</h3>
        Like we can see the table (or <strong>list</strong>) is able to store different value from <strong>different type</strong> in the same list.
        <ul>
            <li>list1 = ['physics', 'chemistry', 1997, 2000];</li>
            <li>list2 = [1, 2, 3, 4, 5 ];</li>
            <li>list3 = ["a", "b", "c", "d"];</li>
        </ul>
    </li>
    <li>
        <h3>Pseudo-code</h3>
        To add exactly same value in pseudo code you need to <strong>declare</strong> the elements one by one. But before to be able to put value in the table you <strong>need to declare the table</strong>.
        <ul>
            <li>init list1[]</li>
            <li>list1[0] <- 'physics'</li>
            <li>list1[1] <- 'chemistry'</li>
            <li>list1[2] <- 1997</li>
            <li>list1[3] <- 2000</li>
            <li>init list2[]</li>
            <li>list2[0] <- 1</li>
            <li>list2[1] <- 2</li>
            <li>list2[2] <- 3</li>
            <li>list2[3] <- 4</li>
            <li>list2[4] <- 5</li>
            <li>init list3[]</li>
            <li>list3[0] <- "a"</li>
            <li>list3[1] <- "b"</li>
            <li>list3[2] <- "c"</li>
            <li>list3[3] <- "d"</li>
        </ul>
    </li>
</ul>

<h2><a href="#">Graphic interface</a></h2>
To manipulate the table in the <strong>canvas</strong> you need to declare the array in first. To do that it's similare to a normal variable. You need to select the <strong>purple square</strong>. The little number on the right top is <strong>the number of elements</strong> in the array. After write the name of the array you can <strong>drag and drop it on the area</strong>. The array will be <strong>empty</strong>.
<img src="./view/img/declArr.jpg"/>
To add value you need to drag and drop value <strong>inside</strong>. To do that you can choose to put inside the array a <strong>varible or just a value</strong>. The value will be put at <strong>the end</strong> of the array. The following elements are the <strong>only</strong> two element you can put in the array.
<img src="./view/img/valueAdd.jpg"/>
<h2><a href="#">Advanced functionality (in Python)</a></h2>
The array can have some <strong>additional content</strong> name function. A <strong>function</strong> is use to make more interractions with an element. For example:
<ul>
    <li>list = [1, 2, 3, 4, 5 ];</li>
    <li>len(list);</li>
    <li>list.append(6)</li>
    <li>list[0] = 10</li>
</ul>
<strong>Len(nameOfTheList):</strong> the function len() is use to <strong>return the size</strong> of the array for exemple in that case it will return five because in the array name list we have five values.<br />
<strong>nameOfTheList.append(element):</strong> this function is use to <strong>add</strong> an element to <strong>the end</strong> of the array. Like that you can add elements to the array.<br />
<strong>nameOfTheList[index]:</strong> this line is use <strong>to access</strong> to the element number "index" in the table name "nameOfTheList". The element could change or use to <strong>manipulate</strong> the value inside the table. For example: list[0] = 10 (we <strong>put</strong> 10 in the element number 0), var = list[0] (in that case we put the value of <strong>the element 0</strong> of the table in the variable name var).
