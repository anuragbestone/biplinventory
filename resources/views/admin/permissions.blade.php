@extends("layouts.app")

@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="role-permission-main">
        <h4 class="rpm-title">Role Permission Matrix</h4>
        <p class="rpm-sub">C = Create | R = Read | U = Update | D = Delete | E = Edit</p>

        <div class="table-container">
            <table class="rpm-table">
                <thead>
                    <tr>
                        <th>Modules</th>
                        <th>Super Admin</th>
                        <th>Plant Manager</th>
                        <th>Warehouse Manager</th>
                        <th>Purchase Manager</th>
                        <th>Vendor Manager</th>
                        <th>Production Manager</th>
                        <th>QC Manager</th>
                        <th>Stock Keeper Manager</th>
                        <th>Sales & Dispatch</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="rpm-row">
                        <td class="rpm-cell">User Management</td>

                        <!-- ROLE COLUMN -->
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" class="perm-check" data-module="Production Line" data-role="Admin" /> C
                                </label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                    </tr>

                    <tr class="rpm-row">
                        <td class="rpm-cell">Warehouse Management</td>

                        <!-- ROLE COLUMN -->
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="rpm-row">
                        <td class="rpm-cell">Stock Management</td>

                        <!-- ROLE COLUMN -->
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                    </tr>

                    <tr class="rpm-row">
                        <td class="rpm-cell">RM/PM Management</td>

                        <!-- ROLE COLUMN -->
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                    </tr>

                    <tr class="rpm-row">
                        <td class="rpm-cell">Vendor Management</td>

                        <!-- ROLE COLUMN -->
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                    </tr>

                    <tr class="rpm-row">
                        <td class="rpm-cell">Production</td>

                        <!-- ROLE COLUMN -->
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                    </tr>

                    <tr class="rpm-row">
                        <td class="rpm-cell">Quality Control</td>

                        <!-- ROLE COLUMN -->
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                    </tr>

                    <tr class="rpm-row">
                        <td class="rpm-cell">Order Management</td>

                        <!-- ROLE COLUMN -->
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                    </tr>

                    <tr class="rpm-row">
                        <td class="rpm-cell">Dispatch Management</td>

                        <!-- ROLE COLUMN -->
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="rpm-row">
                        <td class="rpm-cell">Reports</td>

                        <!-- ROLE COLUMN -->
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>

                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                        <td class="rpm-cell">
                            <div class="perm-group">
                                <label>
                                    <input type="checkbox" /> C</label>
                                <label>
                                    <input type="checkbox" /> R</label>
                                <label>
                                    <input type="checkbox" /> U</label>
                                <label>
                                    <input type="checkbox" /> D</label>
                                <label>
                                    <input type="checkbox" /> E</label>
                            </div>
                        </td>
                    </tr>
                    <!-- Repeat rows same -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="permissionModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pm-modal">
                <div class="modal-header">
                    <h6>Permission Update</h6>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="text-white">Module</label>
                            <input type="text" id="pmModule" class="pm-input" readonly />
                        </div>

                        <div class="mb-2">
                            <label class="text-white">Role</label>
                            <input type="text" id="pmRole" class="pm-input" readonly />
                        </div>

                        <div class="perm-group mt-3">
                            <label>
                                <input type="checkbox" /> C</label>
                            <label>
                                <input type="checkbox" /> R</label>
                            <label>
                                <input type="checkbox" /> U</label>
                            <label>
                                <input type="checkbox" /> D</label>
                            <label>
                                <input type="checkbox" /> E</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="pm-submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".perm-check").forEach((cb) => {
                    cb.addEventListener("click", function () {
                        let module = this.getAttribute("data-module");
                        let role = this.getAttribute("data-role");

                        document.getElementById("pmModule").value = module;
                        document.getElementById("pmRole").value = role;

                        let modal = new bootstrap.Modal(document.getElementById("permissionModal"));
                        modal.show();
                    });
                });

@endsection