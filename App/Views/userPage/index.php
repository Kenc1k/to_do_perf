<div class="content-wrapper kanban">
    <section class="content pb-3">
      <div class="container-fluid h-100">

        <!-- To Do Section -->
        <div class="card card-row card-primary">
          <div class="card-header">
            <h3 class="card-title">To Do</h3>
          </div>
          <div class="card-body">
            <?php if(empty($data['todo'])) { ?>
              <p>No tasks in 'To Do'</p>
            <?php } else { ?>
              <?php foreach($data['todo'] as $task) { ?>
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h5 class="card-title"><?= $task['title'] ?></h5>
                    <div class="card-tools">
                      <form action="/updateTaskStatus" method="POST">
                        <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                        <input type="hidden" name="new_status" value="in progress">
                        <button type="submit" class="btn btn-tool">
                          <i class="fas fa-arrow-right"></i> Move to 'In Progress'
                        </button>
                      </form>
                    </div>
                  </div>
                  <div class="card-body">
                    <h6 style="color: red;">This task is rejected</h6>
                    <p>Comment: <?= $task['comment']?></p>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
        </div>

        <!-- In Progress Section -->
        <div class="card card-row card-default">
          <div class="card-header bg-info">
            <h3 class="card-title">In Progress</h3>
          </div>
          <div class="card-body">
            <?php if(empty($data['in_progress'])) { ?>
              <p>No tasks 'In Progress'</p>
            <?php } else { ?>
              <?php foreach($data['in_progress'] as $task) { ?>
                <div class="card card-light card-outline">
                  <div class="card-header">
                    <h5 class="card-title"><?= $task['title']?></h5>
                    <div class="card-tools">
                      <!-- Button to Move to 'Done' -->
                      <form action="/updateTaskStatus" method="POST">
                        <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                        <input type="hidden" name="new_status" value="done">
                        <button type="submit" class="btn btn-tool">
                          <i class="fas fa-arrow-right"></i> Move to 'Done'
                        </button>
                      </form>
                    </div>
                  </div>
                  <div class="card-body">
                    <p><?= $task['description']?></p>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
        </div>

        <!-- Done Section -->
        <div class="card card-row card-success">
          <div class="card-header">
            <h3 class="card-title">Done</h3>
          </div>
          <div class="card-body">
            <?php if(empty($data['done'])) { ?>
              <p>No tasks 'Done'</p>
            <?php } else { ?>
              <?php foreach($data['done'] as $task) { ?>
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h5 class="card-title"><?= $task['title']?></h5>
                    <div class="card-tools">
                      <?php
                        if($_SESSION['user']['role'] == 'admin'){?>
                          <form action="/updateTaskStatus" method="POST">
                            <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                            <input type="hidden" name="new_status" value="rejected">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#rejectTaskModal"
                                    data-task-id="<?= $task['id'] ?>">
                                <i class="fas fa-arrow-right"></i> Reject Task
                            </button>
                          </form>
                        <?php }    ?>
                    </div>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
        
        <!-- Rejected Section -->
        <div class="card card-row card-danger">
          <div class="card-header">
            <h3 class="card-title">Rejected</h3>
          </div>
          <div class="card-body">
            <?php if(empty($data['rejected'])) { ?>
              <p>No tasks 'Rejected'</p>
            <?php } else { ?>
              <?php foreach($data['rejected'] as $task) { ?>
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h5 class="card-title"><?= $task['title']?></h5>
                    <div class="card-tools">
                    <?php
                        if($_SESSION['user']['role'] == 'admin'){?>
                          <form action="/updateTaskStatus" method="POST">
                            <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                            <input type="hidden" name="new_status" value="todo">
                            <button type="submit" class="btn btn-tool">
                              <i class="fas fa-arrow-right"></i> Move to'To Do'
                            </button>
                          </form>
                        <?php }    ?>
                    </div>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Reject Task Modal -->
<div class="modal fade" id="rejectTaskModal" tabindex="-1" role="dialog" aria-labelledby="rejectTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="/rejectTaskWithComment" method="POST" id="rejectTaskForm">
        <div class="modal-header">
          <h5 class="modal-title" id="rejectTaskModalLabel">Reject Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="task_id" id="modal_task_id">
          <div class="form-group">
            <label for="comment">Reason for rejection</label>
            <textarea name="comment" id="modal_comment" class="form-control" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Commit</button>
        </div>
      </form>
    </div>
  </div>
</div>
