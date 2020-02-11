<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
?>  
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="shortcut icon" href="Images/ampersand-full.256.png" type="favicon/ico" />
        <meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="CSS/StyleProj_1.css"/>
    </head>
    <body>
        <?php
        include_once './includes/Menu.php';
        ?>
        <div id="content">
          <?php if (login_check($mysqli) == true) : ?>
            <p>
                A hasty generalization is a fallacy in which a conclusion that is reached is not logically justified by sufficient or unbiased evidence. It's also called an insufficient sample, a converse accident, a faulty generalization, a biased generalization, jumping to a conclusion, secundum quid, and a neglect of qualifications.


Author Robert B. Parker illustrates the concept via an excerpt from his novel "Sixkill":

"It was a rainy day in Harvard Square, so the foot traffic through the atrium from Mass Ave to Mount Auburn Street was heavier than it might have been if the sun were out. A lot of people were carrying umbrellas, which most of them furled inside. I had always thought that Cambridge, in the vicinity of Harvard, might have had the most umbrellas per capita of any place in the world. People used them when it snowed. In my childhood, in Laramie, Wyoming, we used to think people who carried umbrellas were sissies. It was almost certainly a hasty generalization, but I had never encountered a hard argument against it."

A Too-Small Sample Size
By definition, an argument based on a hasty generalization always proceeds from the particular to the general. It takes a small sample and tries to extrapolate an idea about that sample and apply it to a larger population, and it doesn't work. T. Edward Damer explains:

"It is not uncommon for an arguer to draw a conclusion or generalization based on only a few instances of a phenomenon. In fact, a generalization is often drawn from a single piece of supporting data, an act that might be described as committing the fallacy of the lonely fact....Some areas of inquiry have quite sophisticated guidelines for determining the sufficiency of a sample, such as in voter preference samples or television viewing samples. In many areas, however, there are no such guidelines to assist us in determining what would be sufficient grounds for the truth of a particular conclusion."
—From "Attacking Faulty Reasoning," 4th ed. Wadsworth, 2001

Generalizations as a whole, hasty or not, are problematic at best. Even so, a large sample size won't always get you off the hook. The sample you're looking to generalize needs to be representative of the population as a whole, and it should be random. For example, the polls leading up to the 2016 presidential election missed segments of the population who eventually came out to vote for Donald Trump and thus underestimated his supporters and their potential impact on the election. Pollsters knew the race would be close, however, by not having a representative sample to generalize the outcome, they got it wrong. 

Ethical Ramifications
Stereotypes come about from trying to make generalizations about people or groups of them. Doing it is at best a minefield and at worst, has ethical considerations. Julia T. Wood explains:

"A hasty generalization is a broad claim based on too-limited evidence. It is unethical to assert a broad claim when you have only anecdotal or isolated evidence or instances. Consider two examples of hasty generalizations based on inadequate data:
"Three congressional representatives have had affairs. Therefore, members of Congress are adulterers.
"An environmental group illegally blocked loggers and workers at a nuclear plant. Therefore, environmentalists are radicals who take the law into their own hands.
"In each case, the conclusion is based on limited evidence. In each case the conclusion is hasty and fallacious."
—From "Communication in Our Lives," 6th ed. Wadsworth, 2012
Critical Thinking Is Key
Overall, to avoid making, spreading, or believing hasty generalizations, take a step back, analyze the opinion, and consider the source. If a statement comes from a biased source, then the point of view behind it needs to inform your understanding of the stated opinion, as it gives it context. To find the truth, look for evidence both supporting and opposing a statement because, as the adage says, there are two sides to every story—and the truth often lies somewhere in the middle.  
            </p>
            <p>

            </p> <?php else : ?>
            <p>
                <span class="error"></span> Please <a href="LoginPage.php">login</a>.
            </p>
        <?php endif; ?>
            
            
        </div>        
    </body>

    <?php
    include_once './includes/rodape.php';
    ?>
</html>
