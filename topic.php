<!--
PHP file for a COS10026 Project by React Lions
Author: 
Duy Khoa Pham (103515617)
Gurmehar Singh (103510447)
Anh Minh Nguyen (103178955)
Bradley Bowering (102673815)
Andrew Moutsos(103982376)
last modified: 27.05.2022 
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="COS10026 Assignment 2" />
    <meta name="keywords" content="HTML, CSS, JavaScript" />
    <meta name="author" content="React Lions" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/style.css" />
    <title>Topic</title>
</head>

<body>
    <!--Header(with menu)-->
    <?php 
        include ("header.inc");
        include ("menu.inc");
        echo menu("topic");
        echo "</header>"
    ?>
 
    <!--Main-->
    <main id="topic-main">
        <div class="bullets">
            <div class="slider-container">
                <div class="slider">
                    <div class="slides">
                        <div id="slide_1" class="slide">
                            <section class="slide_text">
                                <p class="emojicon">💪</p>
                                <h3>Large community</h3>
                                <p class="content">React has a large community with many developers building useful public packages to enable better development processes. Furthermore, several well-known firms (Facebook, Instagram, Github, and Netflix) use React for development</p>
                            </section>
                            <a class="slide_prev" href="#slide_6" title="Prev"></a>
                            <a class="slide_next" href="#slide_2" title="Next"></a>
                        </div>
                        <div id="slide_2" class="slide">
                            <section class="slide_text">
                                <p class="emojicon">🧱</p>
                                <h3>Component-Based</h3>
                                <p class="content">Compose encapsulated components that maintain their own state to create complicated UIs. Rich data can be readily transported through the application and state can be kept off of the DOM since component functionality is defined in JavaScript instead of templates.</p>
                            </section>
                            <a class="slide_prev" href="#slide_1" title="Prev"></a>
                            <a class="slide_next" href="#slide_4" title="Next"></a>
                        </div>
                        <div id="slide_4" class="slide">
                            <section class="slide_text">
                                <p class="emojicon">💹</p>
                                <h3>Performance</h3>
                                <p class="content">ReactJS is a fast and safe framework. Additionally, It also would not have many performance difficulties as well as not have a built-in dependency injection container.</p>
                            </section>
                            <a class="slide_prev" href="#slide_2" title="Prev"></a>
                            <a class="slide_next" href="#slide_5" title="Next"></a>
                        </div>
                        <div id="slide_5" class="slide">
                            <section class="slide_text">
                                <p class="emojicon">💡</p>
                                <h3>Flexibility</h3>
                                <p class="content">The ability to sprinkle React into existing apps adds to its flexibility. React may be used to replace individual items on a page until the entire application is updated.</p>
                            </section>
                            <a class="slide_prev" href="#slide_4" title="Prev"></a>
                            <a class="slide_next" href="#slide_6" title="Next"></a>
                        </div>
                        <div id="slide_6" class="slide">
                            <section class="slide_text">
                                <p class="emojicon">💻</p>
                                <h3>Testability</h3>
                                <p class="content">Applications built using ReactJS would be simple to test. Triggers, events, functions, and debugging the code might be all simple to set up. In addition, the code is simple to debug.</p>
                            </section>
                            <a class="slide_prev" href="#slide_5" title="Prev"></a>
                            <a class="slide_next" href="#slide_1" title="Next"></a>
                        </div>
                    </div>
                    <div class="slider_nav">
                        <a class="slider_navlink" href="#slide_1"></a>
                        <a class="slider_navlink" href="#slide_2"></a>
                        <a class="slider_navlink" href="#slide_4"></a>
                        <a class="slider_navlink" href="#slide_5"></a>
                        <a class="slider_navlink" href="#slide_6"></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- timeline -->
        <section id="timeline">
            <h2 class="topic-h1">History of React</h2>
            <div class="timeline-wrapper">
                <div class="container left">
                    <article class="content">
                        <h3>2010</h3>
                        <p>Facebook launched XHP into its PHP stack and made it open source</p>
                    </article>
                </div>
                <div class="container right">
                    <article class="content">
                        <h3>2011</h3>
                        <p>Jordan Walke, a software engineer at Facebook, created an early prototype of React called FaxJS</p>
                    </article>
                </div>
                <div class="container left">
                    <article class="content">
                        <h3>2012</h3>
                        <p>Facebook Ads had become messy and hard to control and they needed a solution for it; Jordan Walke created ReactJS to try and solve this problem</p>
                    </article>
                </div>
                <div class="container right">
                    <article class="content">
                        <h3>2013</h3>
                        <p>This was the big year for ReactJS when Jordan Walke introduced ReactJS and it became open source 
                        </p>
                    </article>
                </div>
                <div class="container left">
                    <article class="content">
                        <h3>2014</h3>
                        <p>ReactJS had gained popularity and started to demonstrate its major strengths to potential users</p>
                    </article>
                </div>
                <div class="container right">
                    <article class="content">
                        <h3>2015</h3>
                        <p>React is in use with many well known companies like Meta (Facebook), Netflix and GitHub</p>
                    </article>
                </div>
                <div class="container left">
                    <article class="content">
                        <h3>2016</h3>
                        <p>ReactJS is mainstream</p>
                    </article>
                </div>

            </div>
        </section>
        <!-- table -->
        
        <section id="table">
            <h2 id="table-h1" class="topic-h1">Comparison</h2>
            <table id="vstable">
                <caption><strong>ReactJS v/s Angular v/s VueJS </strong> </caption>
                <tr>
                    <th></th>
                    <th>ReactJS </th>
                    <th>Angular</th>
                    <th>VueJs </th>
                </tr>
                <tr>
                    <td>Initial release </td>
                    <td>2013 </td>
                    <td>2016 </td>
                    <td>2014</td>

                </tr>
                <tr>
                    <td>Github stars

                    </td>
                    <td>184k</td>
                    <td>80.2k </td>
                    <td>194k</td>
                </tr>
                <tr>
                    <td>Used by</td>
                    <td>Netflix, Github, Facebook </td>
                    <td>Google, McDonald </td>
                    <td>Alibaba, Xiaomi </td>
                </tr>
                <tr>
                    <td>Job Listing </td>
                    <td>107,366</td>
                    <td>105,123</td>
                    <td>15,842</td>
                </tr>
                <tr>
                    <td>Component</td>
                    <td>Flexible</td>
                    <td>Confirmed</td>
                    <td>Flexible</td>
                </tr>
                <tr>
                    <td>Developer Loved Framework</td>
                    <td>74.5%</td>
                    <td>57.6%</td>
                    <td>73.6%</td>
                </tr>
                <tr>
                    <td>Weekly NPM Downloads</td>
                    <td>12,849,833 </td>
                    <td>2,395,825 </td>
                    <td>3,224,505</td>
                </tr>
            </table>
            <aside>
                <ol>
                    <li>React and Vue have an advantage in flexibility and developer popularity over Angular.</li>
                    <li>As for labor opportunity, Angular and React have a much larger desirability than Vue.</li>
                    <li>ReactJS and Angular are used by many famous western websites whereas VueJS is more prominently used amongst Chinese companies.</li>
                    <li>ReactJS and VueJS score higher on the stack overflow developer loved web frameworks survey than Angular due to their versatility and easier learning curve.</li>
                </ol>
            </aside>
        </section>
        <!-- chart -->
        
        <section id="chart">
            <h2 class="topic-h1">Trends</h2>
            <figure>
                <img src="./images/chart.jpeg" alt="chart" id="chart-img" usemap="#chart-workmap" />
                <figcaption>NPM trends of Angular, ReactJS and VueJS</figcaption>
            </figure>
            <map name="chart-workmap">
                <area shape="rect" coords="0,0,2200,2450" alt="react" href="https://www.npmtrends.com/react-vs-vue-vs-@angular/core">
            </map>
            <ul>
                <li>ReactJS has always been the most downloaded framework at 16 million downloads, while VueJS and Angular only have around 3 million each.</li>
                <li>Over time, ReactJS has grown in popularity and has reached its current peak at approximately 16,000,000 download turns on 13 February 2022. </li>
                <li>VueJS and Angular have developed steadily but their growth has not been as stable as ReactJS.</li>
            </ul>
        </section>
        
        <section id="definition">
            <h2 class="topic-h1">Definitions of Key Terms</h2>
            <dl id="defi">
                <dt><strong>JavaScript:</strong></dt>
                <dd>A popular computer programming language, normally used to control the behavior of a webpage.</dd>
                <dt><strong>Framework:</strong></dt>
                <dd>Acts as a base for software projects that provides generic functionality for development.</dd>
                <dt><strong>NPM(Node Package Manager):</strong></dt>
                <dd>A package manager keeps track of what software is installed on your computer and alter the software on your device. NPM is designed to work with JavaScript packages and maintained by npm.</dd>
                <dt><strong>PHP:</strong></dt>
                <dd>PHP is another mainstream, open source scripting language that is suited for web development and is run server side.</dd>
            </dl>
        </section>
        
        <section id="references">
            <h2 class="topic-h1">REFERENCES</h2>
            <ol id="ref_list">
                <li>Meta Open Source, 2022,<em> Getting Started - React,</em> Reactjs.org , viewed 23 March 2022,
                    <p>&lt;<a>https://reactjs.org/docs/getting-started.html</a>&gt;</p>
                </li>
                <li>John Potter, 2022,<em> @angular/core vs react vs vue,</em> Npm trends , viewed 23 March 2022,
                    <p>&lt;<a>https://www.npmtrends.com/react-vs-vue-vs-@angular/core</a>&gt;</p>
                </li>
                <li>Andrei Neagoie, 2018, <em>Tech Trends Showdown 🏆: React vs. Angular vs. Vue,</em> Zero To Mastery, viewed 23 March 2022,
                    <p>&lt;<a>https://zerotomastery.io/blog/tech-trends-showdown-react-vs-angular-vs-vue</a>&gt;</p>
                </li>
                <li>Merve Agca, 2021,<em> Angular vs React vs Vue : Which one is the best choice for 2021?,</em> Radity, viewed 23 March 2022,
                    <p>&lt;<a>https://radity.com/en/digital-magazine/angular-vs-react-vs-vue-which-one-is-the-best-choice-for-2021</a>&gt;</p>
                </li>
                <li>Npm, 2022,<em> vue - npm,</em> viewed 23 March 2022,
                    <p>&lt;<a>https://www.npmjs.com/package/vue</a>&gt;</p>
                </li>
                <li>Npm, 2022,<em> react - npm,</em> viewed 23 March 2022,
                    <p>&lt;<a>https://www.npmjs.com/package/react</a>&gt;</p>
                </li>
                <li>Npm, 2022,<em> @angular/cli - npm,</em> viewed 23 March 2022,
                    <p>&lt;<a>https://www.npmjs.com/package/@angular/cli</a>&gt;</p>
                </li>
                <li>Pluralsight, 2020,<em> 6 reasons to use React (and a few reasons not to),</em> viewed 23 March 2022,
                    <p>&lt;<a>https://www.pluralsight.com/blog/software-development/6-reasons-to-us-react</a>&gt;</p>
                </li>
                <li>Stack Overflow, 2021,<em> Stack Overflow Developer Survey 2021,</em> viewed 31 March 2022,
                    <p>&lt;<a>https://insights.stackoverflow.com/survey/2021#section-most-loved-dreaded-and-wanted-web-frameworks</a>&gt;</p>
                </li>
                <li>RisingStack Engineering, 2022,<em> The History of React.js on a Timeline - RisingStack Engineering,</em> RisingStack Blog, viewed 31 March 2022,
                    <p>&lt;<a>https://blog.risingstack.com/the-history-of-react-js-on-a-timeline/</a>&gt;</p>
                </li>
                <li>Angular, 2022,<em> GitHub - angular/angular: the modern web developer's platform,</em> GitHub, viewed 23 March 2022,
                    <p>&lt;<a>https://github.com/angular/angular</a>&gt;</p>
                </li>
                <li>Facebook, 2022,<em> GitHub - facebook/react: a declarative, efficient, and flexible JavaScript library for building user interfaces,</em> GitHub, viewed 23 March 2022,
                    <p>&lt;<a>https://github.com/facebook/react</a>&gt;</p>
                </li>
                <li>Vue.js, 2022,<em> GitHub - vuejs/vue: 🖖Vue.js is a progressive, incrementally-adoptable JavaScript framework for building UI on the web,</em> GitHub, viewed 23 March 2022,
                    <p>&lt;<a>https://github.com/vuejs/vue</a>&gt;</p>
                </li>
            </ol>
        </section>
    </main>
    
    <!--Footer-->
    <?php include_once 'footer.inc'; ?>
</body>

</html>
