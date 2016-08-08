<?php include("include_pages/checks_counter_inc.php"); ?>


<div class="widget increase" id="new-hp">
    <a href="?action=close&atype=ready">
        <span>
            <?php echo $redyecas; ?>
        </span>
        <p><strong>Download </strong>Now</p>
    </a>
</div> 

<div class="widget increase" id="new-hp">
    <a href="?action=wip&atype=cases">
        <span>
            <?php echo $wipcas; ?>
        </span>
        <p><strong>In Progress</strong></p>
    </a>
</div>

<div class="widget increase" id="new-hp">
    <a href="?action=notyet&atype=cases">
        <span>
            <?php echo $notyets; ?>
        </span>
        <p><strong>Not Yet </strong>Started</p>
    </a>
</div>

<div class="widget increase" id="new-hp">
    <a href="?action=attention&atype=cases">
        <span>
            <?php echo $nattent; ?>
        </span>
        <p><strong>Need </strong>Attention</p>
    </a>
</div> 

<div class="widget increase" id="new-hp">
    <a href="?action=alert&atype=cases">
        <span>
            <?php echo $balrte; ?>
        </span>
        <p><strong>Be Alert</strong></p>
    </a>
</div>

<div class="widget increase" id="new-hp">
    <a href="?action=close&atype=archived">
        <span>
            <?php echo $closecas; ?>
        </span>
        <p><strong>Archived</strong></p>
    </a>
</div>

