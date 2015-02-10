<?php if(!defined('PLX_ROOT')) exit; ?>
<style>
	h3 {
		font-size: 1.5em;
		padding:10px 0;
		text-decoration: underline;
	}
	pre {
		font-family: consolas, monaco, "bitstream vera sans mono", "courier new", courier, monospace;
		hyphens: none;
		overflow: auto;
		padding: 5px 10px;
		border: 1px solid #ddd;
        color:#fff;
        background: #333;
  
        white-space: pre;           /* CSS 2.0 */
        white-space: pre-wrap;      /* CSS 2.1 */
        /*white-space: pre-line; */     /* CSS 3.0 */
        white-space: -pre-wrap;     /* Opera 4-6 */
        white-space: -o-pre-wrap;   /* Opera 7 */
        white-space: -moz-pre-wrap; /* Mozilla */
        white-space: -hp-pre-wrap;  /* HP Printers */
        word-wrap: break-word;      /* IE 5+ */
        text-indent:0;
	}
	ul {
		list-style-type: disc;
		padding-left: 20px;
	}
	ul li {
		padding:2px;
	}
	ul li ul {
		list-style-type: circle;
	}
</style>
<h2>Aide pour le plugin phpGraphForPluxml</h2>
<p>Le but de ce plugin est de pouvoir afficher des données tabulaires sous forme de graphiques en svg dans les articles ou dans les pages statiques.<br/></p>
<h3>Configuration :</h3>
<p>Pour afficher un graphique, il faut avoir au préalable des données tabulaires, c'est à dire, des données sous forme de tableaux dont la mise en forme générique est la suivante :</p>
<pre>
	[data]
		(index1,donnée1)
		(index2,donnée2)
		(index3,donnée3)
		(index4,donnée4)
		etc...
	[/data]
</pre>
<p>Les données sont donc entre deux balises <code>data</code> et sont de la forme <code>index,donnée</code> entre parenthèses.</p>
<p>L'ensemble de ces données doit être placé entre deux balises <code>graph</code> afin que le graphique soit généré :</p>
<pre>[graph]
	[data]
		(index1,donnée1)
		(index2,donnée2)
		(index3,donnée3)
		(index4,donnée4)
		etc...
	[/data]
[/graph]</pre>
<p>Le graphique généré sera une courbe pleine bleue.</p>
<h3>Options des graphiques</h3>
<p>Il est possible de changer le type de graphique, la couleur des courbes, etc., via des options.</p>
<p>Ces options doivent être placées entre deux balises <code>options</code> et sont de la forme <code>option,valeur</code> entre parenthèses.</p>
<pre>[graph]
	[data]
		(index1,donnée1)
		(index2,donnée2)
		(index3,donnée3)
		(index4,donnée4)
		etc...
	[/data]
	[options]

(type,pie),
(diskLegends,true)

(diskLegendsLineColor,red)
(diskLegendsType,data)

(tooltips,true)
(title,Visites par mois)
[/options]
[/graph]</pre>
<p>Les différentes options sont les suivantes :</p>
<ul>
	<li><strong>'width'</strong> : de type integer (nombre entier) pour fixer la largeur de la grille du graphique</li>
	<li><strong>'height'</strong> : de type integer (nombre entier) pour fixer la hauteur de la grille du graphique</li>
	<li><strong>'paddingTop'</strong> : de type integer (nombre entier) pour fixer l'espace entre le haut du bloc svg et le haut de la grille du graphique</li>
	<li><strong>'type'</strong> : de type chaine de caractères. Les différentes possibilités sont :
		<ul>
			<li><code>line</code>, pour que le graphique soit une courbe (non bésier) </li>
			<li><code>bar</code>, pour que le graphique soit sous forme d'histogramme</li>
			<li><code>pie</code>, pour que le graphique soit sous forme de disque</li>
			<li><code>ring</code>, pour que le graphique soit sous forme d'anneau</li>
			<li><code>stock</code>, pour que le graphique soit sous forme de graphique "boursier" vertical ou</li>
			<li><code>h-stock</code>, pour que le graphique soit sous forme de graphique "boursier" horizontal</li>
		</ul>
	</li>
	<li><strong>'steps'</strong> : de type integer (nombre entier) pour séparer 2 graduations sur l'axe des ordonnées. "steps" est calculé automatiquement mais il est possible d'en fixer la valeur. Cela n'a pas d'effet sur les graphiques <code>stock</code> et <code>h-stock</code></li>
	<li><strong>'filled'</strong> : de type booléen (true ou false) pour remplir les graphiques de type <code>line/bar</code> d'une couleur</li>
	<li><strong>'tooltips'</strong> : de type booléen (true ou false) pour afficher les données dans des infobulles au survol du graphique</li>
	<li><strong>'circles'</strong> : de type booléen (true ou false)  pour afficher des cercles autour des valeurs sur les graphiques de type <code>line</code> ou <code>bar</code>.</li>
	<li><strong>'stroke'</strong> : de type chaine de caractères de la forme <code>#3cc5f1</code>. Couleur des lignes par défaut. Utilisez un array pour personaliser chaque ligne.</li>
	<li><strong>'background'</strong> : de type chaine de caractères de la forme <code>#ffffff</code>. Couleur de la grille de fond. Ne pas utiliser de notation raccourcie (<code>#fff</code>) qui n'est pas compatible avec la méthode __genColor() de phpGraph.</li>
	<li><strong>'opacity'</strong> : de type float (nombre à virgule) entre 0 et 1. Aucun effet sur les diagrammes de type <code>stock</code> ou <code>h-stock</code>.</li>
	<li><strong>'gradient'</strong> : de type array. 2 couleurs de la gauche vers la droite.</li>
	<li><strong>'titleHeight'</strong> : de type integer (nombre entier) pour la hauteur du titre principal</li>
	<li><strong>'tooltipLegend'</strong> : de type chaine de caractères ou array. Texte affiché dans les infobulles avec les valeurs de l'axe y. Chaque texte peut être personalisé en utilisant un array. Aucun effet sur les diagrammes de type <code>stock</code> ou <code>h-stock</code>.</li>
	<li><strong>'legends'</strong> : de type chaine de caractères ou booléen ou array. Légende générale pour chaque diagramme de type <code>line/bar/disk/ring</code> affichée sous le diagramme</li>
	<li><strong>'title'</strong> : de type chaine de caractères. Titre principal. Le titre sera affiché dans une infobulle également.</li>
	<li><strong>'radius'</strong> : de type integer (nombre entier) pour le rayon des diagrammes de type <code>disk/ring</code>.</li>
	<li><strong>'diskLegends'</strong> : de type booléen (true ou false) pour afficher les données autour des diagrammes de type <code>disk/ring</code>.</li>
	<li><strong>'diskLegendsType'</strong> : de type chaine de caractères. Les choix sont <code>data</code>, <code>pourcent</code> ou <code>label</code> affichés autour des diagrammes de type <code>disk/ring</code>.</li>
	<li><strong>'diskLegendsLineColor'</strong> : de type chaine de caractères de la forme <code>#ffffff</code> ou <code>darkgrey</code>. Couleur des lignes joignant les diagrammes de type <code>disk/ring</code> aux légendes.</li>
	<li><strong>'responsive'</strong> : de type booléen (true ou false) pour que le svg ait des dimensions fixes (le svg ne s'adapte plus à la taille de l'écran).</li>
	<li><strong>'paddingLegendX'</strong> : de type integer (nombre entier) pour l'affichage correct de la légende sous le diagramme.</li>
	<li><strong>'paddingLegendY'</strong> : de type integer (nombre entier) pour l'affichage correct de la légende autour du diagramme.</li>
</ul>
<h3>Exemples de personnalisation :</h3>
<p>Le code suivant :
<pre>[graph] 
     [data]
(0,(array(2000,0)(2002,25)(2003,32)(2004,1)(2005,58)(2006,31)(2007,79)(2008,51)(2009,54)(2010,12)(2011,17)(2012,14)(2013,13)))
(1,(array(2000,0)(2002,0)(2003,0)(2004,20)(2005,0)(2006,40)(2007,50)(2008,0)(2009,60)(2010,0)(2011,0)(2012,0)(2013,0)))
(2,(array(2000,0)(2002,-20)(2003,-30)(2004,65)(2005,0)(2006,10)(2007,10)(2008,18)(2009,39)(2010,0)(2011,23)(2012,36)(2013,54)))
(3,(array(2000,0)(2002,0)(2003,3)(2004,1)(2005,5)(2006,2)(2007,3)(2008,3)(2009,5)(2010,8)(2011,9)(2012,5)(2013,2)))
(4,(array(2000,7)(2002,39)(2003,26)(2004,36)(2005,18)(2006,32)(2007,56)(2008,38)(2009,103)(2010,105)(2011,126)(2012,125)(2013,76)))
     [/data]
     [options] 
(steps,50)
(filled,false)
(multi,true)
(tooltips,true)
(diskLegends,true)
(diskLegendsType,label)
(diskLegendsLineColor,pink)
(type,array((2,pie)(3,bar)(4,ring)))
(stroke,(array(0,red)(1,blue)(2,orange)(3,green)(4,deeppink)))
(legends,(array(0,Serie 1)(1,Serie 2)(2,Serie 3)(3,Serie 4)(4,Serie 5)))
(tooltipLegend,(array(0,Exemple de légende : )(1,Autre légende : )(2,Légende pour la série 3 : )(3,Exemple pour la série 4 : )(4,Et la série 5 : )))
(title,Amazing phpGraph)
 [/options]
[/graph]</pre>
donnera :</p>
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xml:lang="fr" xmlns:xlink="http://www.w3/org/1999/xlink" class="graph" width="100%" height="100%" viewBox="0 0 700 590" preserveAspectRatio="xMidYMid meet" id="3f40e0877be11ff3d748c6c4864b2eec">

<defs>
	    <style type="text/css"><![CDATA[
	      
		.draw {
			width:70%;/*Adjust this value to resize svg automatically*/
			margin:auto;
		}
		svg {/*width and height of svg is 100% of dimension of its parent (draw class here)*/
			display: block;
			margin:auto;
			margin-bottom: 50px;
		}
		.graph-title {
			stroke-width:4;
			stroke:transparent;
			fill:#000033;
			font-size: 1.2em;
		}
		.graph-grid {
			stroke-width:1;
			stroke:#c4c4c4;
		}
		.graph-stroke {
			stroke-width:2;
			stroke:#424242;
		}
		.graph-legends {}
		.graph-legend {}
		.graph-legend-stroke {}
		.graph-line {
			stroke-linejoin:round;
			stroke-width:2;
		}
		.graph-fill {
			stroke-width:0;
		}
		.graph-bar {}
		.graph-point {
			stroke-width:1;
			fill:#fff;
			fill-opacity:1;
			stroke-opacity:1;
		}
		.graph-point-active:hover {
			stroke-width:5;
			transition-duration:.9s;
			cursor: pointer;
		}
		 title.graph-tooltip {
			background-color:#d6d6d6;
		}
		.graph-pie {
			cursor: pointer;
			stroke-width:1;
			stroke:#fff;
		}
		text {
			fill:#000;
		}
	
	    ]]></style>
</defs>
	<rect x="50" y="50" width="600" height="300" class="graph-stroke" fill="#ffffff" fill-opacity="1"/>
	<title class="graph-tooltip">Amazing phpGraph</title>
	<text x="350" y="40" text-anchor="middle" class="graph-title">Amazing phpGraph</text>
	<g class="graph-grid">
		<path d="M 50 350 H 650"/>
		<path d="M 50 277.184466019 H 650"/>
		<path d="M 50 204.368932039 H 650"/>
		<path d="M 50 131.553398058 H 650"/>

		<path d="M 100 50 V 350"/>
		<path d="M 150 50 V 350"/>
		<path d="M 200 50 V 350"/>
		<path d="M 250 50 V 350"/>
		<path d="M 300 50 V 350"/>
		<path d="M 350 50 V 350"/>
		<path d="M 400 50 V 350"/>
		<path d="M 450 50 V 350"/>
		<path d="M 500 50 V 350"/>
		<path d="M 550 50 V 350"/>
		<path d="M 600 50 V 350"/>
		<path d="M 650 50 V 350"/>
	</g>
	<g class="graph-x">
		<text x="50" y="370" text-anchor="middle">2000</text>
		<text x="100" y="370" text-anchor="middle">2002</text>
		<text x="150" y="370" text-anchor="middle">2003</text>
		<text x="200" y="370" text-anchor="middle">2004</text>
		<text x="250" y="370" text-anchor="middle">2005</text>
		<text x="300" y="370" text-anchor="middle">2006</text>
		<text x="350" y="370" text-anchor="middle">2007</text>
		<text x="400" y="370" text-anchor="middle">2008</text>
		<text x="450" y="370" text-anchor="middle">2009</text>
		<text x="500" y="370" text-anchor="middle">2010</text>
		<text x="550" y="370" text-anchor="middle">2011</text>
		<text x="600" y="370" text-anchor="middle">2012</text>
		<text x="650" y="370" text-anchor="middle">2013</text>
	</g>
	<g class="graph-y">
		<text x="40" y="350" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >-30</text>		<text x="40" y="277.184466019" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >20</text>		<text x="40" y="204.368932039" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >70</text>		<text x="40" y="131.553398058" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >120</text>	</g>
		<path d="M 50 306.310679612 L
				100 269.902912621
				150 259.708737864
				200 304.854368932
				250 221.844660194
				300 261.165048544
				350 191.262135922
				400 232.038834951
				450 227.669902913
				500 288.834951456
				550 281.553398058
				600 285.922330097
				650 287.378640777" class="graph-line" stroke="red" fill="#fff" fill-opacity="0"/>
	<g class="graph-point">
		<g class="graph-active">
			<circle cx="50" cy="306.310679612" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 0</title>
		</g>
		<g class="graph-active">
			<circle cx="100" cy="269.902912621" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 25</title>
		</g>
		<g class="graph-active">
			<circle cx="150" cy="259.708737864" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 32</title>
		</g>
		<g class="graph-active">
			<circle cx="200" cy="304.854368932" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 1</title>
		</g>
		<g class="graph-active">
			<circle cx="250" cy="221.844660194" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 58</title>
		</g>
		<g class="graph-active">
			<circle cx="300" cy="261.165048544" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 31</title>
		</g>
		<g class="graph-active">
			<circle cx="350" cy="191.262135922" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 79</title>
		</g>
		<g class="graph-active">
			<circle cx="400" cy="232.038834951" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 51</title>
		</g>
		<g class="graph-active">
			<circle cx="450" cy="227.669902913" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 54</title>
		</g>
		<g class="graph-active">
			<circle cx="500" cy="288.834951456" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 12</title>
		</g>
		<g class="graph-active">
			<circle cx="550" cy="281.553398058" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 17</title>
		</g>
		<g class="graph-active">
			<circle cx="600" cy="285.922330097" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 14</title>
		</g>
		<g class="graph-active">
			<circle cx="650" cy="287.378640777" r="3" stroke="red" class="graph-point-active"/>
			<title class="graph-tooltip">Exemple de légende : 13</title>
		</g>
	</g>
		<path d="M 50 306.310679612 L
				100 306.310679612
				150 306.310679612
				200 277.184466019
				250 306.310679612
				300 248.058252427
				350 233.495145631
				400 306.310679612
				450 218.932038835
				500 306.310679612
				550 306.310679612
				600 306.310679612
				650 306.310679612" class="graph-line" stroke="blue" fill="#fff" fill-opacity="0"/>
	<g class="graph-point">
		<g class="graph-active">
			<circle cx="50" cy="306.310679612" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 0</title>
		</g>
		<g class="graph-active">
			<circle cx="100" cy="306.310679612" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 0</title>
		</g>
		<g class="graph-active">
			<circle cx="150" cy="306.310679612" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 0</title>
		</g>
		<g class="graph-active">
			<circle cx="200" cy="277.184466019" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 20</title>
		</g>
		<g class="graph-active">
			<circle cx="250" cy="306.310679612" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 0</title>
		</g>
		<g class="graph-active">
			<circle cx="300" cy="248.058252427" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 40</title>
		</g>
		<g class="graph-active">
			<circle cx="350" cy="233.495145631" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 50</title>
		</g>
		<g class="graph-active">
			<circle cx="400" cy="306.310679612" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 0</title>
		</g>
		<g class="graph-active">
			<circle cx="450" cy="218.932038835" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 60</title>
		</g>
		<g class="graph-active">
			<circle cx="500" cy="306.310679612" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 0</title>
		</g>
		<g class="graph-active">
			<circle cx="550" cy="306.310679612" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 0</title>
		</g>
		<g class="graph-active">
			<circle cx="600" cy="306.310679612" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 0</title>
		</g>
		<g class="graph-active">
			<circle cx="650" cy="306.310679612" r="3" stroke="blue" class="graph-point-active"/>
			<title class="graph-tooltip">Autre légende : 0</title>
		</g>
	</g>

	<rect x="50" y="306.310679612" width="25" height="1" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="75" y="306.310679612" width="50" height="1" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="125" y="301.941747573" width="50" height="4.36893203883" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="175" y="304.854368932" width="50" height="1.45631067961" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="225" y="299.029126214" width="50" height="7.28155339806" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="275" y="303.398058252" width="50" height="2.91262135922" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="325" y="301.941747573" width="50" height="4.36893203883" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="375" y="301.941747573" width="50" height="4.36893203883" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="425" y="299.029126214" width="50" height="7.28155339806" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="475" y="294.660194175" width="50" height="11.6504854369" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="525" y="293.203883495" width="50" height="13.1067961165" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="575" y="299.029126214" width="50" height="7.28155339806" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<rect x="625" y="303.398058252" width="25" height="2.91262135922" class="graph-bar" stroke="green" fill="#fff" fill-opacity="0"/>
	<g class="graph-point">
		<g class="graph-active">
			<circle cx="50" cy="306.310679612" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 0</title>
		</g>
		<g class="graph-active">
			<circle cx="100" cy="306.310679612" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 0</title>
		</g>
		<g class="graph-active">
			<circle cx="150" cy="301.941747573" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 3</title>
		</g>
		<g class="graph-active">
			<circle cx="200" cy="304.854368932" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 1</title>
		</g>
		<g class="graph-active">
			<circle cx="250" cy="299.029126214" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 5</title>
		</g>
		<g class="graph-active">
			<circle cx="300" cy="303.398058252" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 2</title>
		</g>
		<g class="graph-active">
			<circle cx="350" cy="301.941747573" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 3</title>
		</g>
		<g class="graph-active">
			<circle cx="400" cy="301.941747573" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 3</title>
		</g>
		<g class="graph-active">
			<circle cx="450" cy="299.029126214" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 5</title>
		</g>
		<g class="graph-active">
			<circle cx="500" cy="294.660194175" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 8</title>
		</g>
		<g class="graph-active">
			<circle cx="550" cy="293.203883495" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 9</title>
		</g>
		<g class="graph-active">
			<circle cx="600" cy="299.029126214" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 5</title>
		</g>
		<g class="graph-active">
			<circle cx="650" cy="303.398058252" r="3" stroke="green" class="graph-point-active"/><title class="graph-tooltip">Exemple pour la série 4 : 2</title>
		</g>
	</g>

	<g class="graph-legends">
		<rect x="50" y="440" width="10" height="10" fill="green" class="graph-legend-stroke"/>
		<text x="70" y="450" text-anchor="start" class="graph-legend">Serie4</text>
		<rect x="50" y="380" width="10" height="10" fill="red" class="graph-legend-stroke"/>
		<text x="70" y="390" text-anchor="start" class="graph-legend">Serie1</text>
		<rect x="50" y="400" width="10" height="10" fill="blue" class="graph-legend-stroke"/>
		<text x="70" y="410" text-anchor="start" class="graph-legend">Serie2</text>
	</g>
</svg>

<svg width="100%" height="100%" viewBox="0 0 600 840" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" version="1.1" id="3f40e0877be11ff3d748c6c4864b2eec">
<defs>
		<style type="text/css">//<![CDATA[
	      
		.draw {
			width:70%;/*Adjust this value to resize svg automatically*/
			margin:auto;
		}
		svg {/*width and height of svg is 100% of dimension of its parent (draw class here)*/
			display: block;
			margin:auto;
			margin-bottom: 50px;
		}
		.graph-title {
			stroke-width:4;
			stroke:transparent;
			fill:#000033;
			font-size: 1.2em;
		}
		.graph-grid {
			stroke-width:1;
			stroke:#c4c4c4;
		}
		.graph-stroke {
			stroke-width:2;
			stroke:#424242;
		}
		.graph-legends {}
		.graph-legend {}
		.graph-legend-stroke {}
		.graph-line {
			stroke-linejoin:round;
			stroke-width:2;
		}
		.graph-fill {
			stroke-width:0;
		}
		.graph-bar {}
		.graph-point {
			stroke-width:1;
			fill:#fff;
			fill-opacity:1;
			stroke-opacity:1;
		}
		.graph-point-active:hover {
			stroke-width:5;
			transition-duration:.9s;
			cursor: pointer;
		}
		 title.graph-tooltip {
			background-color:#d6d6d6;
		}
		.graph-pie {
			cursor: pointer;
			stroke-width:1;
			stroke:#fff;
		}
		text {
			fill:#000;
		}
	
	    ]]></style>
</defs>
	<text x="300" y="40" text-anchor="middle" class="graph-title">Amazing phpGraph</text>

		<g class="graph-active">
			<circle cx="300" cy="270" r="100" fill="#9416F2" class="graph-pie"/>
			
			<path d=" M 238.709294635 190.984498762 L 177.418589269 111.968997525 L 147.418589269 111.968997525" class="graph-line" stroke="pink" stroke-opacity="0.5" stroke-dasharray="2,2,2" fill="none"/>
			<text x="117.418589269" y="106.968997525" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">2013</text>
			<title class="graph-tooltip">Légende pour la série 3 : 2013 : 54</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 1 1 203.141683887 245.131011284 L 300 270 z" fill="#F1DE4C" class="graph-pie"/>
			
			<path d=" M 201.771274927 288.738131459 L 103.542549854 307.476262917 L 73.5425498543 307.476262917" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="28.5425498543" y="312.476262917" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2012</text>
			<title class="graph-tooltip">Légende pour la série 3 : 2012 : 36</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 1 1 219.098300563 328.778525229 L 300 270 z" fill="#E30CDB" class="graph-pie"/>
			
			<path d=" M 238.709294635 349.015501238 L 177.418589269 428.031002475 L 147.418589269 428.031002475" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="102.418589269" y="433.031002475" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2011</text>
			<title class="graph-tooltip">Légende pour la série 3 : 2011 : 23</title>
		</g>
		<g class="graph-active"><title class="graph-tooltip">Légende pour la série 3 : 2010 : 0</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 1 1 263.187544732 362.977648589 L 300 270 z" fill="#94568E" class="graph-pie"/>
			
			<path d=" M 309.410831332 369.55619646 L 318.821662664 469.112392921 L 288.821662664 469.112392921" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="243.821662664" y="474.112392921" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2009</text>
			<title class="graph-tooltip">Légende pour la série 3 : 2009 : 39</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 353.582679498 354.43279255 L 300 270 z" fill="#E9C256" class="graph-pie"/>
			
			<path d=" M 370.710678119 340.710678119 L 441.421356237 411.421356237 L 471.421356237 411.421356237" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="471.421356237" y="411.421356237" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2008</text>
			<title class="graph-tooltip">Légende pour la série 3 : 2008 : 18</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 384.43279255 323.582679498 L 300 270 z" fill="#0D469A" class="graph-pie"/>
			
			<path d=" M 390.482705247 312.577929157 L 480.965410493 355.155858313 L 510.965410493 355.155858313" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="510.965410493" y="355.155858313" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2007</text>
			<title class="graph-tooltip">Légende pour la série 3 : 2007 : 10</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 395.10565163 300.901699437 L 300 270 z" fill="#52AE69" class="graph-pie"/>
			
			<path d=" M 398.228725073 288.738131459 L 496.457450146 307.476262917 L 526.457450146 307.476262917" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="526.457450146" y="307.476262917" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2006</text>
			<title class="graph-tooltip">Légende pour la série 3 : 2006 : 10</title>
		</g>
		<g class="graph-active"><title class="graph-tooltip">Légende pour la série 3 : 2005 : 0</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 399.802672843 276.279051953 L 300 270 z" fill="#0B28D4" class="graph-pie"/>
			
			<path d=" M 375.011106963 203.868813468 L 450.022213926 137.737626935 L 480.022213926 137.737626935" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="480.022213926" y="137.737626935" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2004</text>
			<title class="graph-tooltip">Légende pour la série 3 : 2004 : 65</title>
		</g>
		<g class="graph-active"><title class="graph-tooltip">Légende pour la série 3 : 2003 : 0</title>
		</g>
		<g class="graph-active"><title class="graph-tooltip">Légende pour la série 3 : 2002 : 0</title>
		</g>
		<g class="graph-active"><title class="graph-tooltip">Légende pour la série 3 : 2000 : 0</title>
		</g><rect x="50" y="500" width="10" height="10" fill="orange" class="graph-legend-stroke"/>
			<text x="70" y="510" class="graph-legend">Serie3</text>	<g class="graph-legends">
		<rect x="70" y="520" width="10" height="10" fill="#A1C75F" class="graph-legend-stroke"/>
		<text x="90" y="530" text-anchor="start" class="graph-legend">2000 : 0</text>
		<rect x="70" y="540" width="10" height="10" fill="#81BF34" class="graph-legend-stroke"/>
		<text x="90" y="550" text-anchor="start" class="graph-legend">2002 : 0</text>
		<rect x="70" y="560" width="10" height="10" fill="#0F9B82" class="graph-legend-stroke"/>
		<text x="90" y="570" text-anchor="start" class="graph-legend">2003 : 0</text>
		<rect x="70" y="580" width="10" height="10" fill="#0B28D4" class="graph-legend-stroke"/>
		<text x="90" y="590" text-anchor="start" class="graph-legend">2004 : 65</text>
		<rect x="70" y="600" width="10" height="10" fill="#B5473E" class="graph-legend-stroke"/>
		<text x="90" y="610" text-anchor="start" class="graph-legend">2005 : 0</text>
		<rect x="70" y="620" width="10" height="10" fill="#52AE69" class="graph-legend-stroke"/>
		<text x="90" y="630" text-anchor="start" class="graph-legend">2006 : 10</text>
		<rect x="70" y="640" width="10" height="10" fill="#0D469A" class="graph-legend-stroke"/>
		<text x="90" y="650" text-anchor="start" class="graph-legend">2007 : 10</text>
		<rect x="70" y="660" width="10" height="10" fill="#E9C256" class="graph-legend-stroke"/>
		<text x="90" y="670" text-anchor="start" class="graph-legend">2008 : 18</text>
		<rect x="70" y="680" width="10" height="10" fill="#94568E" class="graph-legend-stroke"/>
		<text x="90" y="690" text-anchor="start" class="graph-legend">2009 : 39</text>
		<rect x="70" y="700" width="10" height="10" fill="#809452" class="graph-legend-stroke"/>
		<text x="90" y="710" text-anchor="start" class="graph-legend">2010 : 0</text>
		<rect x="70" y="720" width="10" height="10" fill="#E30CDB" class="graph-legend-stroke"/>
		<text x="90" y="730" text-anchor="start" class="graph-legend">2011 : 23</text>
		<rect x="70" y="740" width="10" height="10" fill="#F1DE4C" class="graph-legend-stroke"/>
		<text x="90" y="750" text-anchor="start" class="graph-legend">2012 : 36</text>
		<rect x="70" y="760" width="10" height="10" fill="#9416F2" class="graph-legend-stroke"/>
		<text x="90" y="770" text-anchor="start" class="graph-legend">2013 : 54</text>
	</g>
</svg>

<svg width="100%" height="100%" viewBox="0 0 600 840" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" version="1.1" id="3f40e0877be11ff3d748c6c4864b2eec">
<defs>
		<style type="text/css">//<![CDATA[
	      
		.draw {
			width:70%;/*Adjust this value to resize svg automatically*/
			margin:auto;
		}
		svg {/*width and height of svg is 100% of dimension of its parent (draw class here)*/
			display: block;
			margin:auto;
			margin-bottom: 50px;
		}
		.graph-title {
			stroke-width:4;
			stroke:transparent;
			fill:#000033;
			font-size: 1.2em;
		}
		.graph-grid {
			stroke-width:1;
			stroke:#c4c4c4;
		}
		.graph-stroke {
			stroke-width:2;
			stroke:#424242;
		}
		.graph-legends {}
		.graph-legend {}
		.graph-legend-stroke {}
		.graph-line {
			stroke-linejoin:round;
			stroke-width:2;
		}
		.graph-fill {
			stroke-width:0;
		}
		.graph-bar {}
		.graph-point {
			stroke-width:1;
			fill:#fff;
			fill-opacity:1;
			stroke-opacity:1;
		}
		.graph-point-active:hover {
			stroke-width:5;
			transition-duration:.9s;
			cursor: pointer;
		}
		 title.graph-tooltip {
			background-color:#d6d6d6;
		}
		.graph-pie {
			cursor: pointer;
			stroke-width:1;
			stroke:#fff;
		}
		text {
			fill:#000;
		}
	
	    ]]></style>
</defs>
	<text x="300" y="40" text-anchor="middle" class="graph-title">Amazing phpGraph</text>

		<g class="graph-active">
			<circle cx="300" cy="270" r="100" fill="#13B596" class="graph-pie"/>
			
			<path d=" M 269.098300563 174.89434837 L 238.196601125 79.788696741 L 208.196601125 79.788696741" class="graph-line" stroke="pink" stroke-opacity="0.5" stroke-dasharray="2,2,2" fill="none"/>
			<text x="178.196601125" y="74.788696741" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">2013</text>
			<title class="graph-tooltip">Et la série 5 : 2013 : 76</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 1 1 241.221474771 189.098300563 L 300 270 z" fill="#50AB97" class="graph-pie"/>
			
			<path d=" M 209.517294753 227.422070843 L 119.034589507 184.844141687 L 89.0345895068 184.844141687" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="44.0345895068" y="189.844141687" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2012</text>
			<title class="graph-tooltip">Et la série 5 : 2012 : 125</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 1 1 200.197327157 276.279051953 L 300 270 z" fill="#05A963" class="graph-pie"/>
			
			<path d=" M 215.56720745 323.582679498 L 131.1344149 377.165358996 L 101.1344149 377.165358996" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="56.1344148996" y="382.165358996" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2011</text>
			<title class="graph-tooltip">Et la série 5 : 2011 : 126</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 1 1 251.82463259 357.630668004 L 300 270 z" fill="#73FE85" class="graph-pie"/>
			
			<path d=" M 290.589168668 369.55619646 L 281.178337336 469.112392921 L 251.178337336 469.112392921" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="206.178337336" y="474.112392921" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2010</text>
			<title class="graph-tooltip">Et la série 5 : 2010 : 105</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 330.901699437 365.10565163 L 300 270 z" fill="#65ACFE" class="graph-pie"/>
			
			<path d=" M 366.131186532 345.011106963 L 432.262373065 420.022213926 L 462.262373065 420.022213926" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="462.262373065" y="420.022213926" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2009</text>
			<title class="graph-tooltip">Et la série 5 : 2009 : 103</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 390.482705247 312.577929157 L 300 270 z" fill="#C4FAD3" class="graph-pie"/>
			
			<path d=" M 396.029368568 297.899110604 L 492.058737135 325.798221208 L 522.058737135 325.798221208" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="522.058737135" y="325.798221208" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2008</text>
			<title class="graph-tooltip">Et la série 5 : 2008 : 38</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 399.211470131 282.533323356 L 300 270 z" fill="#37BDA6" class="graph-pie"/>
			
			<path d=" M 399.55619646 260.589168668 L 499.112392921 251.178337336 L 529.112392921 251.178337336" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="529.112392921" y="251.178337336" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2007</text>
			<title class="graph-tooltip">Et la série 5 : 2007 : 56</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 395.10565163 239.098300563 L 300 270 z" fill="#FBEC59" class="graph-pie"/>
			
			<path d=" M 390.482705247 227.422070843 L 480.965410493 184.844141687 L 510.965410493 184.844141687" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="510.965410493" y="184.844141687" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2006</text>
			<title class="graph-tooltip">Et la série 5 : 2006 : 32</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 384.43279255 216.417320502 L 300 270 z" fill="#D281AC" class="graph-pie"/>
			
			<path d=" M 380.901699437 211.221474771 L 461.803398875 152.442949542 L 491.803398875 152.442949542" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="491.803398875" y="152.442949542" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2005</text>
			<title class="graph-tooltip">Et la série 5 : 2005 : 18</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 377.051324278 206.257601025 L 300 270 z" fill="#5E1A76" class="graph-pie"/>
			
			<path d=" M 366.131186532 194.988893037 L 432.262373065 119.977786074 L 462.262373065 119.977786074" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="462.262373065" y="119.977786074" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2004</text>
			<title class="graph-tooltip">Et la série 5 : 2004 : 36</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 353.582679498 185.56720745 L 300 270 z" fill="#C5AF4B" class="graph-pie"/>
			
			<path d=" M 345.399049974 180.899347581 L 390.798099948 91.7986951623 L 420.798099948 91.7986951623" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="420.798099948" y="91.7986951623" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2003</text>
			<title class="graph-tooltip">Et la série 5 : 2003 : 26</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 336.812455268 177.022351411 L 300 270 z" fill="#27BF09" class="graph-pie"/>
			
			<path d=" M 321.81432414 172.408323806 L 343.628648279 74.8166476123 L 373.628648279 74.8166476123" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="373.628648279" y="74.8166476123" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2002</text>
			<title class="graph-tooltip">Et la série 5 : 2002 : 39</title>
		</g>
		<g class="graph-active">
			<path d="M 300 170  A 100 100  0 0 1 306.279051953 170.197327157 L 300 270 z" fill="#5FE410" class="graph-pie"/>
			
			<path d=" M 303.141075908 170.049343963 L 306.282151816 70.0986879269 L 336.282151816 70.0986879269" fill="none" class="graph-line" stroke="pink" stroke-opacity="0.5"  stroke-dasharray="2,2,2"/>
			<text x="336.282151816" y="70.0986879269" class="graph-legend" stroke="darkgrey" stroke-opacity="0.5">  2000</text>
			<title class="graph-tooltip">Et la série 5 : 2000 : 7</title>
		</g><rect x="50" y="500" width="10" height="10" fill="deeppink" class="graph-legend-stroke"/>
			<text x="70" y="510" class="graph-legend">Serie5</text>	<g class="graph-legends">
		<rect x="70" y="520" width="10" height="10" fill="#5FE410" class="graph-legend-stroke"/>
		<text x="90" y="530" text-anchor="start" class="graph-legend">2000 : 7</text>
		<rect x="70" y="540" width="10" height="10" fill="#27BF09" class="graph-legend-stroke"/>
		<text x="90" y="550" text-anchor="start" class="graph-legend">2002 : 39</text>
		<rect x="70" y="560" width="10" height="10" fill="#C5AF4B" class="graph-legend-stroke"/>
		<text x="90" y="570" text-anchor="start" class="graph-legend">2003 : 26</text>
		<rect x="70" y="580" width="10" height="10" fill="#5E1A76" class="graph-legend-stroke"/>
		<text x="90" y="590" text-anchor="start" class="graph-legend">2004 : 36</text>
		<rect x="70" y="600" width="10" height="10" fill="#D281AC" class="graph-legend-stroke"/>
		<text x="90" y="610" text-anchor="start" class="graph-legend">2005 : 18</text>
		<rect x="70" y="620" width="10" height="10" fill="#FBEC59" class="graph-legend-stroke"/>
		<text x="90" y="630" text-anchor="start" class="graph-legend">2006 : 32</text>
		<rect x="70" y="640" width="10" height="10" fill="#37BDA6" class="graph-legend-stroke"/>
		<text x="90" y="650" text-anchor="start" class="graph-legend">2007 : 56</text>
		<rect x="70" y="660" width="10" height="10" fill="#C4FAD3" class="graph-legend-stroke"/>
		<text x="90" y="670" text-anchor="start" class="graph-legend">2008 : 38</text>
		<rect x="70" y="680" width="10" height="10" fill="#65ACFE" class="graph-legend-stroke"/>
		<text x="90" y="690" text-anchor="start" class="graph-legend">2009 : 103</text>
		<rect x="70" y="700" width="10" height="10" fill="#73FE85" class="graph-legend-stroke"/>
		<text x="90" y="710" text-anchor="start" class="graph-legend">2010 : 105</text>
		<rect x="70" y="720" width="10" height="10" fill="#05A963" class="graph-legend-stroke"/>
		<text x="90" y="730" text-anchor="start" class="graph-legend">2011 : 126</text>
		<rect x="70" y="740" width="10" height="10" fill="#50AB97" class="graph-legend-stroke"/>
		<text x="90" y="750" text-anchor="start" class="graph-legend">2012 : 125</text>
		<rect x="70" y="760" width="10" height="10" fill="#13B596" class="graph-legend-stroke"/>
		<text x="90" y="770" text-anchor="start" class="graph-legend">2013 : 76</text>
	</g><circle cx="300" cy="270" r="50" fill="#ffffff" class="graph-pie"/>
</svg>
<p>Ce dernier :</p>
<p><pre>
[graph]
[data]
(Jan,array((open,35)(close,20)(min,10)(max,37)))
(Feb,array((open,28)(close,17)(min,11)(max,32)))
(Mar,array((open,17)(close,25)(min,14)(max,33)))
(Apr,array(open,27)(close,20)(min,11)(max,29)))
(May,array((open,12)(close,25)(min,9)(max,29)))
(Jun,array((open,12)(close,23)(min,4)(max,25)))
(Jul,array((open,20)(close,16)(min,3)(max,22)))
(Aug,array((open,15)(close,29)(min,7)(max,34)))
(Sep,array((open,20)(close,26)(min,9)(max,29)))
(Oct,array((open,28)(close,17)(min,5)(max,31)))
(Nov,array((open,15)(close,29)(min,8)(max,37)))
(Dec,array((open,12)(close,60)(min,10)(max,67)))
[/data]
[options]
(type,stock)
(tooltips,true)
[/options]
[/graph]</pre></p>
<p>Donnera :</p>
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xml:lang="fr" xmlns:xlink="http://www.w3/org/1999/xlink" class="graph" width="100%" height="100%" viewBox="0 0 692.307692308 420" preserveAspectRatio="xMidYMid meet" id="df69dabbb5b13975250269a5a140726e">

<defs>
	    <style type="text/css"><![CDATA[
	      
		.draw {
			width:70%;/*Adjust this value to resize svg automatically*/
			margin:auto;
		}
		svg {/*width and height of svg is 100% of dimension of its parent (draw class here)*/
			display: block;
			margin:auto;
			margin-bottom: 50px;
		}
		.graph-title {
			stroke-width:4;
			stroke:transparent;
			fill:#000033;
			font-size: 1.2em;
		}
		.graph-grid {
			stroke-width:1;
			stroke:#c4c4c4;
		}
		.graph-stroke {
			stroke-width:2;
			stroke:#424242;
		}
		.graph-legends {}
		.graph-legend {}
		.graph-legend-stroke {}
		.graph-line {
			stroke-linejoin:round;
			stroke-width:2;
		}
		.graph-fill {
			stroke-width:0;
		}
		.graph-bar {}
		.graph-point {
			stroke-width:1;
			fill:#fff;
			fill-opacity:1;
			stroke-opacity:1;
		}
		.graph-point-active:hover {
			stroke-width:5;
			transition-duration:.9s;
			cursor: pointer;
		}
		 title.graph-tooltip {
			background-color:#d6d6d6;
		}
		.graph-pie {
			cursor: pointer;
			stroke-width:1;
			stroke:#fff;
		}
		text {
			fill:#000;
		}
	
	    ]]></style>
</defs>
	<rect x="50" y="50" width="600" height="300" class="graph-stroke" fill="#ffffff" fill-opacity="1"/>
	<title class="graph-tooltip">Amazing phpGraph</title>
	<text x="350" y="40" text-anchor="middle" class="graph-title">Amazing phpGraph</text>
	<g class="graph-grid">
		<path d="M 50 350 H 650"/>
		<path d="M 50 309.459459459 H 650"/>
		<path d="M 50 268.918918919 H 650"/>
		<path d="M 50 228.378378378 H 650"/>
		<path d="M 50 187.837837838 H 650"/>
		<path d="M 50 147.297297297 H 650"/>
		<path d="M 50 106.756756757 H 650"/>
		<path d="M 50 66.2162162162 H 650"/>

		<path d="M 96.1538461538 50 V 350"/>
		<path d="M 142.307692308 50 V 350"/>
		<path d="M 188.461538462 50 V 350"/>
		<path d="M 234.615384615 50 V 350"/>
		<path d="M 280.769230769 50 V 350"/>
		<path d="M 326.923076923 50 V 350"/>
		<path d="M 373.076923077 50 V 350"/>
		<path d="M 419.230769231 50 V 350"/>
		<path d="M 465.384615385 50 V 350"/>
		<path d="M 511.538461538 50 V 350"/>
		<path d="M 557.692307692 50 V 350"/>
		<path d="M 603.846153846 50 V 350"/>
		<path d="M 650 50 V 350"/>
	</g>
	<g class="graph-x">
		<text x="50" y="370" text-anchor="middle"></text>
		<text x="96.1538461538" y="370" text-anchor="middle">Jan</text>
		<text x="142.307692308" y="370" text-anchor="middle">Feb</text>
		<text x="188.461538462" y="370" text-anchor="middle">Mar</text>
		<text x="234.615384615" y="370" text-anchor="middle">Apr</text>
		<text x="280.769230769" y="370" text-anchor="middle">May</text>
		<text x="326.923076923" y="370" text-anchor="middle">Jun</text>
		<text x="373.076923077" y="370" text-anchor="middle">Jul</text>
		<text x="419.230769231" y="370" text-anchor="middle">Aug</text>
		<text x="465.384615385" y="370" text-anchor="middle">Sep</text>
		<text x="511.538461538" y="370" text-anchor="middle">Oct</text>
		<text x="557.692307692" y="370" text-anchor="middle">Nov</text>
		<text x="603.846153846" y="370" text-anchor="middle">Dec</text>
		<text x="650" y="370" text-anchor="middle"></text>
	</g>
	<g class="graph-y">
		<text x="40" y="350" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >0</text>		<text x="40" y="309.459459459" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >10</text>		<text x="40" y="268.918918919" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >20</text>		<text x="40" y="228.378378378" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >30</text>		<text x="40" y="187.837837838" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >40</text>		<text x="40" y="147.297297297" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >50</text>		<text x="40" y="106.756756757" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >60</text>		<text x="40" y="66.2162162162" text-anchor="end" baseline-shift="-1ex" dominant-baseline="middle" >70</text>	</g>

	<defs>
		<g id="plotLimit1709197990">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#95F4BE" stroke-opacity="1"/>
		</g>
	</defs>

	<rect x="84.6153846154" y="208.108108108" width="23.0769230769" height="60.8108108108" class="graph-bar" fill="#95F4BE" fill-opacity="1"/>
	<path d="M96.1538461538 268.918918919  L96.1538461538 200 " class="graph-line" stroke="#95F4BE" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1709197990" transform="translate(91.1538461538,200)"/>
	<path d="M96.1538461538 208.108108108  L96.1538461538 309.459459459 " class="graph-line" stroke="#95F4BE" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1709197990" transform="translate(91.1538461538,309.459459459)"/>
		<g class="graph-active">
			<circle cx="96.1538461538" cy="208.108108108" r="1" stroke="#95F4BE" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">35</title>
		</g>
		<g class="graph-active">
			<circle cx="96.1538461538" cy="268.918918919" r="1" stroke="#95F4BE" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">20</title>
		</g>
		<g class="graph-active">
			<circle cx="96.1538461538" cy="200" r="1" stroke="#95F4BE" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">37</title>
		</g>
		<g class="graph-active">
			<circle cx="96.1538461538" cy="309.459459459" r="1" stroke="#95F4BE" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">10</title>
		</g>
	<defs>
		<g id="plotLimit163584885">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#DC315A" stroke-opacity="1"/>
		</g>
	</defs>

	<rect x="130.769230769" y="236.486486486" width="23.0769230769" height="44.5945945946" class="graph-bar" fill="#DC315A" fill-opacity="1"/>
	<path d="M142.307692308 281.081081081  L142.307692308 220.27027027 " class="graph-line" stroke="#DC315A" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit163584885" transform="translate(137.307692308,220.27027027)"/>
	<path d="M142.307692308 236.486486486  L142.307692308 305.405405405 " class="graph-line" stroke="#DC315A" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit163584885" transform="translate(137.307692308,305.405405405)"/>
		<g class="graph-active">
			<circle cx="142.307692308" cy="236.486486486" r="1" stroke="#DC315A" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">28</title>
		</g>
		<g class="graph-active">
			<circle cx="142.307692308" cy="281.081081081" r="1" stroke="#DC315A" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">17</title>
		</g>
		<g class="graph-active">
			<circle cx="142.307692308" cy="220.27027027" r="1" stroke="#DC315A" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">32</title>
		</g>
		<g class="graph-active">
			<circle cx="142.307692308" cy="305.405405405" r="1" stroke="#DC315A" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">11</title>
		</g>
	<defs>
		<g id="plotLimit804576320">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#E71C80" stroke-opacity="1"/>
		</g>
	</defs>

	<path d="M188.461538462 248.648648649  L188.461538462 216.216216216 " class="graph-line" stroke="#E71C80" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit804576320" transform="translate(183.461538462,216.216216216)"/>
	<path d="M188.461538462 281.081081081  L188.461538462 293.243243243 " class="graph-line" stroke="#E71C80" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit804576320" transform="translate(183.461538462,293.243243243)"/>
		<g class="graph-active">
			<circle cx="188.461538462" cy="281.081081081" r="1" stroke="#E71C80" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">17</title>
		</g>
		<g class="graph-active">
			<circle cx="188.461538462" cy="248.648648649" r="1" stroke="#E71C80" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">25</title>
		</g>
		<g class="graph-active">
			<circle cx="188.461538462" cy="216.216216216" r="1" stroke="#E71C80" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">33</title>
		</g>
		<g class="graph-active">
			<circle cx="188.461538462" cy="293.243243243" r="1" stroke="#E71C80" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">14</title>
		</g>
	<defs>
		<g id="plotLimit915500573">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#F4905B" stroke-opacity="1"/>
		</g>
	</defs>

	<rect x="223.076923077" y="240.540540541" width="23.0769230769" height="28.3783783784" class="graph-bar" fill="#F4905B" fill-opacity="1"/>
	<path d="M234.615384615 268.918918919  L234.615384615 232.432432432 " class="graph-line" stroke="#F4905B" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit915500573" transform="translate(229.615384615,232.432432432)"/>
	<path d="M234.615384615 240.540540541  L234.615384615 305.405405405 " class="graph-line" stroke="#F4905B" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit915500573" transform="translate(229.615384615,305.405405405)"/>
		<g class="graph-active">
			<circle cx="234.615384615" cy="240.540540541" r="1" stroke="#F4905B" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">27</title>
		</g>
		<g class="graph-active">
			<circle cx="234.615384615" cy="268.918918919" r="1" stroke="#F4905B" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">20</title>
		</g>
		<g class="graph-active">
			<circle cx="234.615384615" cy="232.432432432" r="1" stroke="#F4905B" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">29</title>
		</g>
		<g class="graph-active">
			<circle cx="234.615384615" cy="305.405405405" r="1" stroke="#F4905B" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">11</title>
		</g>
	<defs>
		<g id="plotLimit758646549">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#F42976" stroke-opacity="1"/>
		</g>
	</defs>

	<path d="M280.769230769 248.648648649  L280.769230769 232.432432432 " class="graph-line" stroke="#F42976" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit758646549" transform="translate(275.769230769,232.432432432)"/>
	<path d="M280.769230769 301.351351351  L280.769230769 313.513513514 " class="graph-line" stroke="#F42976" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit758646549" transform="translate(275.769230769,313.513513514)"/>
		<g class="graph-active">
			<circle cx="280.769230769" cy="301.351351351" r="1" stroke="#F42976" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">12</title>
		</g>
		<g class="graph-active">
			<circle cx="280.769230769" cy="248.648648649" r="1" stroke="#F42976" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">25</title>
		</g>
		<g class="graph-active">
			<circle cx="280.769230769" cy="232.432432432" r="1" stroke="#F42976" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">29</title>
		</g>
		<g class="graph-active">
			<circle cx="280.769230769" cy="313.513513514" r="1" stroke="#F42976" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">9</title>
		</g>
	<defs>
		<g id="plotLimit704193047">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#314659" stroke-opacity="1"/>
		</g>
	</defs>

	<path d="M326.923076923 256.756756757  L326.923076923 248.648648649 " class="graph-line" stroke="#314659" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit704193047" transform="translate(321.923076923,248.648648649)"/>
	<path d="M326.923076923 301.351351351  L326.923076923 333.783783784 " class="graph-line" stroke="#314659" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit704193047" transform="translate(321.923076923,333.783783784)"/>
		<g class="graph-active">
			<circle cx="326.923076923" cy="301.351351351" r="1" stroke="#314659" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">12</title>
		</g>
		<g class="graph-active">
			<circle cx="326.923076923" cy="256.756756757" r="1" stroke="#314659" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">23</title>
		</g>
		<g class="graph-active">
			<circle cx="326.923076923" cy="248.648648649" r="1" stroke="#314659" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">25</title>
		</g>
		<g class="graph-active">
			<circle cx="326.923076923" cy="333.783783784" r="1" stroke="#314659" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">4</title>
		</g>
	<defs>
		<g id="plotLimit1609357279">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#4CA156" stroke-opacity="1"/>
		</g>
	</defs>

	<rect x="361.538461538" y="268.918918919" width="23.0769230769" height="16.2162162162" class="graph-bar" fill="#4CA156" fill-opacity="1"/>
	<path d="M373.076923077 285.135135135  L373.076923077 260.810810811 " class="graph-line" stroke="#4CA156" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1609357279" transform="translate(368.076923077,260.810810811)"/>
	<path d="M373.076923077 268.918918919  L373.076923077 337.837837838 " class="graph-line" stroke="#4CA156" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1609357279" transform="translate(368.076923077,337.837837838)"/>
		<g class="graph-active">
			<circle cx="373.076923077" cy="268.918918919" r="1" stroke="#4CA156" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">20</title>
		</g>
		<g class="graph-active">
			<circle cx="373.076923077" cy="285.135135135" r="1" stroke="#4CA156" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">16</title>
		</g>
		<g class="graph-active">
			<circle cx="373.076923077" cy="260.810810811" r="1" stroke="#4CA156" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">22</title>
		</g>
		<g class="graph-active">
			<circle cx="373.076923077" cy="337.837837838" r="1" stroke="#4CA156" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">3</title>
		</g>
	<defs>
		<g id="plotLimit1896511749">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#86CA14" stroke-opacity="1"/>
		</g>
	</defs>

	<path d="M419.230769231 232.432432432  L419.230769231 212.162162162 " class="graph-line" stroke="#86CA14" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1896511749" transform="translate(414.230769231,212.162162162)"/>
	<path d="M419.230769231 289.189189189  L419.230769231 321.621621622 " class="graph-line" stroke="#86CA14" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1896511749" transform="translate(414.230769231,321.621621622)"/>
		<g class="graph-active">
			<circle cx="419.230769231" cy="289.189189189" r="1" stroke="#86CA14" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">15</title>
		</g>
		<g class="graph-active">
			<circle cx="419.230769231" cy="232.432432432" r="1" stroke="#86CA14" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">29</title>
		</g>
		<g class="graph-active">
			<circle cx="419.230769231" cy="212.162162162" r="1" stroke="#86CA14" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">34</title>
		</g>
		<g class="graph-active">
			<circle cx="419.230769231" cy="321.621621622" r="1" stroke="#86CA14" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">7</title>
		</g>
	<defs>
		<g id="plotLimit147910602">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#E738B1" stroke-opacity="1"/>
		</g>
	</defs>

	<path d="M465.384615385 244.594594595  L465.384615385 232.432432432 " class="graph-line" stroke="#E738B1" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit147910602" transform="translate(460.384615385,232.432432432)"/>
	<path d="M465.384615385 268.918918919  L465.384615385 313.513513514 " class="graph-line" stroke="#E738B1" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit147910602" transform="translate(460.384615385,313.513513514)"/>
		<g class="graph-active">
			<circle cx="465.384615385" cy="268.918918919" r="1" stroke="#E738B1" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">20</title>
		</g>
		<g class="graph-active">
			<circle cx="465.384615385" cy="244.594594595" r="1" stroke="#E738B1" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">26</title>
		</g>
		<g class="graph-active">
			<circle cx="465.384615385" cy="232.432432432" r="1" stroke="#E738B1" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">29</title>
		</g>
		<g class="graph-active">
			<circle cx="465.384615385" cy="313.513513514" r="1" stroke="#E738B1" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">9</title>
		</g>
	<defs>
		<g id="plotLimit1910545856">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#C0D1E6" stroke-opacity="1"/>
		</g>
	</defs>

	<rect x="500" y="236.486486486" width="23.0769230769" height="44.5945945946" class="graph-bar" fill="#C0D1E6" fill-opacity="1"/>
	<path d="M511.538461538 281.081081081  L511.538461538 224.324324324 " class="graph-line" stroke="#C0D1E6" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1910545856" transform="translate(506.538461538,224.324324324)"/>
	<path d="M511.538461538 236.486486486  L511.538461538 329.72972973 " class="graph-line" stroke="#C0D1E6" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1910545856" transform="translate(506.538461538,329.72972973)"/>
		<g class="graph-active">
			<circle cx="511.538461538" cy="236.486486486" r="1" stroke="#C0D1E6" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">28</title>
		</g>
		<g class="graph-active">
			<circle cx="511.538461538" cy="281.081081081" r="1" stroke="#C0D1E6" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">17</title>
		</g>
		<g class="graph-active">
			<circle cx="511.538461538" cy="224.324324324" r="1" stroke="#C0D1E6" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">31</title>
		</g>
		<g class="graph-active">
			<circle cx="511.538461538" cy="329.72972973" r="1" stroke="#C0D1E6" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">5</title>
		</g>
	<defs>
		<g id="plotLimit1734394017">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#9F2A68" stroke-opacity="1"/>
		</g>
	</defs>

	<path d="M557.692307692 232.432432432  L557.692307692 200 " class="graph-line" stroke="#9F2A68" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1734394017" transform="translate(552.692307692,200)"/>
	<path d="M557.692307692 289.189189189  L557.692307692 317.567567568 " class="graph-line" stroke="#9F2A68" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1734394017" transform="translate(552.692307692,317.567567568)"/>
		<g class="graph-active">
			<circle cx="557.692307692" cy="289.189189189" r="1" stroke="#9F2A68" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">15</title>
		</g>
		<g class="graph-active">
			<circle cx="557.692307692" cy="232.432432432" r="1" stroke="#9F2A68" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">29</title>
		</g>
		<g class="graph-active">
			<circle cx="557.692307692" cy="200" r="1" stroke="#9F2A68" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">37</title>
		</g>
		<g class="graph-active">
			<circle cx="557.692307692" cy="317.567567568" r="1" stroke="#9F2A68" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">8</title>
		</g>
	<defs>
		<g id="plotLimit1305230983">
			<path d="M 0 0 L 10 0" class="graph-line" stroke="#D09E42" stroke-opacity="1"/>
		</g>
	</defs>

	<path d="M603.846153846 106.756756757  L603.846153846 78.3783783784 " class="graph-line" stroke="#D09E42" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1305230983" transform="translate(598.846153846,78.3783783784)"/>
	<path d="M603.846153846 301.351351351  L603.846153846 309.459459459 " class="graph-line" stroke="#D09E42" fill="#fff" fill-opacity="0"/><use xlink:href="#plotLimit1305230983" transform="translate(598.846153846,309.459459459)"/>
		<g class="graph-active">
			<circle cx="603.846153846" cy="301.351351351" r="1" stroke="#D09E42" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">12</title>
		</g>
		<g class="graph-active">
			<circle cx="603.846153846" cy="106.756756757" r="1" stroke="#D09E42" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">60</title>
		</g>
		<g class="graph-active">
			<circle cx="603.846153846" cy="78.3783783784" r="1" stroke="#D09E42" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">67</title>
		</g>
		<g class="graph-active">
			<circle cx="603.846153846" cy="309.459459459" r="1" stroke="#D09E42" opacity="0" class="graph-point-active"/>
	<title class="graph-tooltip">10</title>
		</g>
</svg>
<h3><em>Nota Bene</em> :</h3>
<p>Mis à part sur cette aide où le code n'est pas produit par la bibliothèque, les svg générés par le plugin sont exportables en png via un javascript automatiquement ajouté en bas de page, pour les navigateurs récents.<br/><br/></p>
<p>Pour les navigateurs anciens (IE &lt; 10 ), une tentative de conversion des svg en vml est réalisée.<br/>Si la conversion échoue, le plugin affichera soit une zone blanche, soit un png, s'il a préalablement été généré via un navigateur récent.<br/><br/></p>
<p>Le mieux étant quand même de conseiller à vos utilisateurs de télécharger un navigateur digne de ce nom.</p>
<h3>À vous de jouer !</h3>
<p>N'hésitez pas à remonter les bugs que vous trouverez au niveau du <a href="https://www.github.com/jerrywham/phpGraphForPluxml" onclick="window.open(this.href);return false;">plugin</a> ou de la <a href="https://www.github.com/jerrywham/phpGraph" onclick="window.open(this.href);return false;">bibliothèque de génération des svg</a></p>