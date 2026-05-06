<?php
\App\Models\Ikan::whereHas('user', function($q) { $q->where('role', 'admin'); })->update(['user_id' => null]);
echo "Fixed";
