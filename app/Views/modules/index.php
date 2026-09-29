<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">Module Manager</h1>
        <p class="text-muted small mb-0">Autodiscovered student group modules operating autonomously within the central ERP core.</p>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-grid-3x3-gap-fill me-2"></i>Discovered Modules Directory</h6>
        <span class="badge badge-burgundy"><?= count($modules) ?> Discovered</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Module Slug</th>
                        <th>System / Module Title</th>
                        <th>Class Section</th>
                        <th>Version</th>
                        <th class="text-center">Permissions</th>
                        <th class="text-center">Widgets</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 140px;">Toggle Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($modules)): ?>
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                No student modules discovered yet in <code>/modules/</code>. Use <code>php scripts/make-module.php</code> to scaffold a module.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $i = 1; foreach ($modules as $slug => $m): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><code><?= e($slug) ?></code></td>
                                <td>
                                    <strong class="text-marsu-burgundy"><?= e($m['name']) ?></strong>
                                    <?php if (!empty($m['description'])): ?>
                                        <div class="text-muted" style="font-size:0.75rem;"><?= e($m['description']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-gold"><?= e($m['section'] ?? 'BSIS 3') ?></span></td>
                                <td><code>v<?= e($m['version'] ?? '1.0.0') ?></code></td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border"><?= count($m['permissions'] ?? []) ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border"><?= count($m['widgets'] ?? []) ?></span>
                                </td>
                                <td>
                                    <?php if (!empty($m['enabled'])): ?>
                                        <span class="badge badge-soft-success">Enabled</span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-danger">Disabled</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <form method="POST" action="<?= url('modules/toggle') ?>" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="slug" value="<?= e($slug) ?>">
                                        <input type="hidden" name="enabled" value="<?= !empty($m['enabled']) ? '0' : '1' ?>">
                                        <button type="submit" class="btn btn-sm <?= !empty($m['enabled']) ? 'btn-outline-danger' : 'btn-outline-success' ?> py-0 px-2" style="font-size: 0.75rem;">
                                            <?= !empty($m['enabled']) ? 'Disable' : 'Enable' ?>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
