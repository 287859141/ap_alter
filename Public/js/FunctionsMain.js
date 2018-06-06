/**
 * add one option of a select to another select.
 *
 */
function myaddItem(ItemList,Target)
{
    for(var x = 0; x < ItemList.length; x++)
    {
        var opt = ItemList[x].value;
		var arrname=String(opt).split('|');
		flag = true;
		for (var y=0;y<Target.length;y++)
		{
			var myopt = Target.options[y];
			if (myopt.value == arrname[0])
			{
				flag = false;
			}
		}
		if(flag)
		{
			Target.options[Target.options.length] = new Option(arrname[1], arrname[0], 0, 0);
		}
    }
}

function addItem(ItemList,Target)
{
    for(var x = 0; x < ItemList.length; x++)
    {
        var opt = ItemList.options[x];
        if (opt.selected)
        {
            flag = true;
            for (var y=0;y<Target.length;y++)
            {
                var myopt = Target.options[y];
                if (myopt.value == opt.value)
                {
                    flag = false;
                }
            }
            if(flag)
            {
                Target.options[Target.options.length] = new Option(opt.text, opt.value, 0, 0);
				//alert(opt.text+" "+opt.value);
            }
        }
    }
}

/**
 * move one selected option from a select.
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function delItem(ItemList)
{
    for(var x=ItemList.length-1;x>=0;x--)
    {
        var opt = ItemList.options[x];
        if (opt.selected)
        {
            ItemList.options[x] = null;
        }
    }
}

/**
 * move one selected option up from a select.
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function upItem(ItemList)
{
    for(var x=1;x<ItemList.length;x++)
    {
        var opt = ItemList.options[x];
        if(opt.selected)
        {
            tmpUpValue = ItemList.options[x-1].value;
            tmpUpText  = ItemList.options[x-1].text;
            ItemList.options[x-1].value = opt.value;
            ItemList.options[x-1].text  = opt.text;
            ItemList.options[x].value = tmpUpValue;
            ItemList.options[x].text  = tmpUpText;
            ItemList.options[x-1].selected = true;
            ItemList.options[x].selected = false;
            break;
        }
    }
}

/**
 * move one selected option down from a select.
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function downItem(ItemList)
{
    for(var x=0;x<ItemList.length;x++)
    {
        var opt = ItemList.options[x];
        if(opt.selected)
        {
            tmpUpValue = ItemList.options[x+1].value;
            tmpUpText  = ItemList.options[x+1].text;
            ItemList.options[x+1].value = opt.value;
            ItemList.options[x+1].text  = opt.text;
            ItemList.options[x].value = tmpUpValue;
            ItemList.options[x].text  = tmpUpText;
            ItemList.options[x+1].selected = true;
            ItemList.options[x].selected = false;
            break;
        }
    }
}

/**
 * select all items of a select
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function selectItem(ItemList)
{
    for(var x=ItemList.length-1;x>=0;x--)
    {
        var opt = ItemList.options[x];
        opt.selected = true;
    }
}

/**
 * select one item of a select
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function selectOneItem(ItemList,ItemValue)
{
    for(I = 0;I < ItemList.options.length; I++)
    {
        if(ItemValue == ItemList.options[I].value)
        {
           ItemList.options[I].selected = true;
        }
    }
}

/**
 * join items of an select with ",".
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function joinItem(ItemList)
{
    var OptionList = new Array();
    for (var x=0; x<ItemList.length;x++)
    {
        OptionList[x] = ItemList.options[x].value;
    }
    return OptionList.join("|");
}

/**
 * set the query form when document loaded.
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function setQueryForm(QueryFieldNumber)
{
    for(J = 0; J < QueryFieldNumber; J ++)
    {
        setQueryOperator(J);
        setQueryValue(J);
    }
}

/**
 * set the Operator list to select correct item according to the query field selected.
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function setQueryOperator(I)
{
    var FieldName = document.getElementById("Field" + I).value;

    if (FieldName.match("Name|Title|Path|OS"))
    {
        selectOneItem(document.getElementById("Operator" + I),"LIKE");
    }
    else if (FieldName.match("Date"))
    {
        selectOneItem(document.getElementById("Operator" + I),"<");
    }
    else
    {
        selectOneItem(document.getElementById("Operator" + I),"=");
    }
}

/**
 * create an select.
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function createSelect(SelectName,TextArray,ValueArray)
{
    SelectString  = '<select name="' + SelectName + '" id="' + SelectName + '" style="width:90">';
    for(I = 0; I <= TextArray.length - 1;I ++)
    {
        SelectString += '<option value="' + ValueArray[I] + '">' + TextArray[I] + '</option>';
    }
    SelectString += '</select>';
    return SelectString;
}

/**
 * create an input.
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function createInput(InputName,InputValue)
{
    return '<input type="text" name="' + InputName + '"  id="' + InputName + '" value="' + InputValue + '"' + ' style="width:90" class="MyInput">';
}

/**
 * set the value item.
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function setQueryValue(I)
{
    var FieldName     = document.getElementById("Field" + I).value;
    var Continer      = document.getElementById("Continer" + I);
    var OriginalValue = document.getElementById("Value" + I).value;

    if(!document.getElementById("AutoComplete").checked)
    {
        Continer.innerHTML = createInput("Value" + I,OriginalValue);
        return;
    }
    else
    {
        if (FieldName.match("BugStatus"))
        {
            Continer.innerHTML = createSelect("Value" + I,StatusText,StatusValue);
        }
        else if (FieldName.match("Severity"))
        {
            Continer.innerHTML = createSelect("Value" + I,SeverityText,SeverityValue);
        }
        else if (FieldName.match("BugType"))
        {
            Continer.innerHTML = createSelect("Value" + I,TypeText,TypeValue);
        }
        else if (FieldName.match("BugOS"))
        {
            Continer.innerHTML = createSelect("Value" + I,OSText,OSValue);
        }
        else if (FieldName.match("Resolution"))
        {
            Continer.innerHTML = createSelect("Value" + I,ResolutionText,ResolutionValue);
        }
        else if (FieldName.match("OpenedBy|AssignedTo|ResolvedBy|ClosedBy|LastEditedBy|MailTo"))
        {
            Continer.innerHTML = createSelect("Value" + I,UserText,UserValue);
        }
        else if (FieldName.match("Date"))
        {
            Continer.innerHTML = createInput("Value" + I,getDateTime());
        }
        else
        {
            Continer.innerHTML = createInput("Value" + I,OriginalValue);
        }
    }
}
/**
 * Get current datetime
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 */
function getDateTime()
{
    objDate = new Date();
    return objDate.getFullYear() + "-" + (objDate.getMonth() + 1) + "-" + objDate.getDate() + " " + objDate.getHours() + ":" + objDate.getMinutes();
}