<?php 
 
namespace App\Models; 
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
 
class TeacherProfile extends Model 
{ 
    protected $fillable = [ 
        'teacher_id', 'address', 'father_name', 'mother_name',  
        'emergency_contact', 'blood_group', 'profile_picture' 
    ]; 
 
    // Inverse of One-to-One 
    public function teacher(): BelongsTo 
    { 
        return $this->belongsTo(Teacher::class); 
    } 
}