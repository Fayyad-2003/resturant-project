@extends('admin.layouts.master')

@section('content')
    <!-- Page Header -->
    <div class="admin-topbar">
        <h1 class="topbar-title">Dashboard</h1>
        <div class="topbar-actions">
            <a href="#" target="_blank" class="topbar-btn">
                <i class="fas fa-globe"></i>
                <span class="ml-2">Visit Store</span>
            </a>
        </div>
    </div>

    <!-- Earnings Section -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Earnings Overview</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="stat-card">
                <div class="stat-card-icon bg-info">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h4 class="stat-card-title">Today Total Earnings</h4>
                <p class="stat-card-value">$2,450</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-primary">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h4 class="stat-card-title">This Week Total Earnings</h4>
                <p class="stat-card-value">$18,750</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-success">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h4 class="stat-card-title">This Year Total Earnings</h4>
                <p class="stat-card-value">$245,800</p>
            </div>
        </div>
    </div>

    <!-- Today Orders -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Today's Orders</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="stat-card">
                <div class="stat-card-icon bg-primary">
                    <i class="fas fa-sort-amount-down"></i>
                </div>
                <h4 class="stat-card-title">Total Orders</h4>
                <p class="stat-card-value">45</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <h4 class="stat-card-title">Pending Orders</h4>
                <p class="stat-card-value">12</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4 class="stat-card-title">Complete Orders</h4>
                <p class="stat-card-value">28</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-danger">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h4 class="stat-card-title">Cancelled Orders</h4>
                <p class="stat-card-value">5</p>
            </div>
        </div>
    </div>

    <!-- This Week Orders -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">This Week's Orders</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="stat-card">
                <div class="stat-card-icon bg-primary">
                    <i class="fas fa-sort-amount-down"></i>
                </div>
                <h4 class="stat-card-title">Total Orders</h4>
                <p class="stat-card-value">328</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <h4 class="stat-card-title">Pending Orders</h4>
                <p class="stat-card-value">45</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4 class="stat-card-title">Complete Orders</h4>
                <p class="stat-card-value">268</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-danger">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h4 class="stat-card-title">Cancelled Orders</h4>
                <p class="stat-card-value">15</p>
            </div>
        </div>
    </div>

    <!-- This Month Orders -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">This Month's Orders</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="stat-card">
                <div class="stat-card-icon bg-primary">
                    <i class="fas fa-sort-amount-down"></i>
                </div>
                <h4 class="stat-card-title">Total Orders</h4>
                <p class="stat-card-value">1,245</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <h4 class="stat-card-title">Pending Orders</h4>
                <p class="stat-card-value">156</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4 class="stat-card-title">Complete Orders</h4>
                <p class="stat-card-value">1,025</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-danger">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h4 class="stat-card-title">Cancelled Orders</h4>
                <p class="stat-card-value">64</p>
            </div>
        </div>
    </div>

    <!-- This Year Orders -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">This Year's Orders</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="stat-card">
                <div class="stat-card-icon bg-primary">
                    <i class="fas fa-sort-amount-down"></i>
                </div>
                <h4 class="stat-card-title">Total Orders</h4>
                <p class="stat-card-value">14,856</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <h4 class="stat-card-title">Pending Orders</h4>
                <p class="stat-card-value">1,234</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4 class="stat-card-title">Complete Orders</h4>
                <p class="stat-card-value">12,856</p>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon bg-danger">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h4 class="stat-card-title">Cancelled Orders</h4>
                <p class="stat-card-value">766</p>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="data-table-card">
        <h2 class="card-header">Recent Orders</h2>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Email</th>
                        <th>Order No</th>
                        <th>Items</th>
                        <th>Total Cost</th>
                        <th>Status</th>
                        <th>Date & Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>customer@example.com</td>
                        <td class="font-medium">ORD-10001</td>
                        <td>3 items</td>
                        <td class="font-medium">$125.50</td>
                        <td>
                            <span class="badge badge-warning">Pending</span>
                        </td>
                        <td>
                            <div class="text-sm">
                                <div>Aug 31, 2026</div>
                                <div class="text-[#706f6c]">2:30 PM</div>
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-dark">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>john.doe@example.com</td>
                        <td class="font-medium">ORD-10002</td>
                        <td>5 items</td>
                        <td class="font-medium">$245.00</td>
                        <td>
                            <span class="badge badge-info">Processing</span>
                        </td>
                        <td>
                            <div class="text-sm">
                                <div>Aug 31, 2026</div>
                                <div class="text-[#706f6c]">1:15 PM</div>
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-dark">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>jane.smith@example.com</td>
                        <td class="font-medium">ORD-10003</td>
                        <td>2 items</td>
                        <td class="font-medium">$85.75</td>
                        <td>
                            <span class="badge badge-success">Delivered</span>
                        </td>
                        <td>
                            <div class="text-sm">
                                <div>Aug 30, 2026</div>
                                <div class="text-[#706f6c]">11:45 AM</div>
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-dark">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>mike.wilson@example.com</td>
                        <td class="font-medium">ORD-10004</td>
                        <td>4 items</td>
                        <td class="font-medium">$165.25</td>
                        <td>
                            <span class="badge badge-danger">Cancelled</span>
                        </td>
                        <td>
                            <div class="text-sm">
                                <div>Aug 30, 2026</div>
                                <div class="text-[#706f6c]">9:20 AM</div>
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-dark">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
