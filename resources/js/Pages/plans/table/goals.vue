<script setup></script>

<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Goals</h3>
            <div class="card-tools">
                <button type="button"  class="btn bg-gradient-defualt btn-xs">
                    <i class="fas fa-plus"></i>
                    Add new goal
                </button>
                <button type="button"  class="btn bg-gradient-defualt btn-xs">
                    <i class="fas fa-plus"></i>
                    view sub-goals
                </button>
                <button type="button"  class="btn bg-gradient-defualt btn-xs">
                    <i class="fas fa-times"></i>
                    
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            Goals
                        </th>
                        <th style="width: 20%">
                            Plan
                        </th>
                        <th style="width: 30%">
                            Completion Date
                        </th>
                        <th>
                            Progress
                        </th>
                        <th style="width: 8%" class="text-center">
                            Status
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            Test Goals
                        </td>
                        <td>
                            <a>
                                AdminLTE v3
                            </a>
                            <br/>
                            <small>
                                Created 01.01.2019
                            </small>
                        </td>
                        <td>
                            
                        </td>
                        <td class="project_progress">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                </div>
                            </div>
                            <small>
                                57% Complete
                            </small>
                        </td>
                        <td class="project-state">
                            <span class="badge badge-warning">On Progress</span>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-success btn-sm" href="#">
                                <i class="fas fa-check">
                                </i>
                                Complete
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>