
<?php if (!empty($reports)):?>
<div class="report-content">
    <div class='table-responsive'>
        <h3><?=__('Reports')?></h3>


        <table border='1'>
            <thead>
                <tr>
                    <th><?=$this->Paginator->sort('id')?></th>
                    <th><?=$this->Paginator->sort('user_id')?></th>
                     <th><?=$this->Paginator->sort('email')?></th>
                    <th><?=$this->Paginator->sort('report type')?></th>
                    <th><?=$this->Paginator->sort('message')?></th>
                    <th><?=$this->Paginator->sort('created')?></th>


                    <th class="actions"><?=__('Actions')?></th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($reports as $report):?>
                <tr>
                    <td><?=$this->Number->format($report->id)?></td>
                    <td><?=$this->Number->format($report->user_id)?></td>
                    <td><?=($report->email)?></td>
                    <td><?=($report->report_type)?></td>
                    <td><?=($report->message)?></td>
                    <td><?=($report->created)?></td>

<td>
<?=$this->Html->link(__('View'), ['action' => 'viewrequest', $report->id])?>

<?=$this->Html->link(__('Edit'), ['action' => 'edit', $report->id])?>

<?=$this->Form->postLink(__('delete'), ['action' => 'Cancelrequest', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $report->id)])?>
</td>
                </tr>
<?php endforeach;?>
</tbody>
        </table>
                </div>

<div class="paginator">
        <ul class="pagination">
<?=$this->Paginator->first('<< '.__('first'))?>
            <?=$this->Paginator->prev('< '.__('previous'))?>
            <?=$this->Paginator->numbers()?>
            <?=$this->Paginator->next(__('next').' >')?>
            <?=$this->Paginator->last(__('last').' >>')?>
        </ul>
        <p><?=$this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total'))?></p>
    </div>

</div>

<?php endif;?>
<?php if (empty($report)):?>
<h2>No one has reported yet </h2>
<?php endif;?>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>