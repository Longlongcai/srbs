<div class="container">
<div class = "row">
    <p>
        <?php
            echo $this->Paginator->counter(array('format' => 'range'));
        ?>
    </p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('上一页'), array(),
        null, array('class' => 'prev disabled'));
        echo $this->Paginator->next(__('下一页') . ' >', array(),
        null, array('class' => 'next disabled'));
        ?>
    </div>
<div>
</div>