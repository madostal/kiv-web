<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <title>Ukázka práce s Twig</title>
    <style>
        div {margin-bottom:20px; border-bottom:1px solid blue;}
        body {background-color:rgb(250,240,250);}
    </style>
</head>
<body>

	<h1>{{ nadpis|title }}</h1>
	
	<div>
       Kompletní obsah stránky:<br> 
	   {{ obsah|raw }}
	</div>
    
    <div>
       Obsah stránky bez HTML:<br> 
	   {{ obsah | striptags }}
	</div>
    
    <div>
       Obsah stránky se zobrazeným HTML:<br> 
	   {{ obsah|e }}
	</div>
    
    <div>
        Uživatelé:<br>
        {% for key, user in uzivatele %}
            {{key+1}}: <b>{{ user.prijmeni | upper }}</b>, {{ user.jmeno }}<br>
        {% else %}
            Nebyl nalezen žádný uživatel.
        {% endfor %}
    </div>

    <div>
        Tabulka ovoce:<br>
        <table border="1">
            {% for radek in ovoce|batch(3, '---') %}
                <tr>
                    {% for kus in radek %}
                        <td>{{ kus }}</td>
                    {% endfor %}
                </tr>
            {% endfor %}
        </table>
    </div>
    
    <div>
        Vypis ovoce do řádku:<br>
        
    </div>
</body>
</html>