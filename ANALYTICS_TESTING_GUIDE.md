# Testing the Analytics Page

## Quick Access

**URL**: http://localhost:8000/admin/shelter/analytics

**Requirements**:
- Logged in as shelter admin
- User has `shelter_location` field set

## Current State

The analytics page is **100% functional** and will display real data based on:
1. Your assigned shelter location
2. Existing pets in database for that location
3. Adoption applications for those pets

## How to View Analytics

### Step 1: Ensure Shelter Location is Set
```bash
docker exec pawpal_app php artisan tinker
```

```php
$user = App\Models\User::where('email', 'admin@pawpal.com')->first();
$user->shelter_location = 'Manila Shelter';
$user->save();
```

### Step 2: Add Test Pets for Your Location
```php
// In tinker
$shelter = 'Manila Shelter'; // Use your assigned location

// Create available pets
App\Models\Pet::create([
    'name' => 'Buddy',
    'type' => 'Dog',
    'breed' => 'Golden Retriever',
    'age' => 'Adult',
    'gender' => 'Male',
    'size' => 'Large',
    'location' => $shelter,
    'is_available' => true,
    'description' => 'Friendly dog',
    'image' => 'pets/test.jpg'
]);

// Create more pets
for ($i = 1; $i <= 10; $i++) {
    App\Models\Pet::create([
        'name' => 'Pet ' . $i,
        'type' => $i % 2 == 0 ? 'Dog' : 'Cat',
        'breed' => 'Mixed',
        'age' => 'Young',
        'gender' => $i % 2 == 0 ? 'Male' : 'Female',
        'size' => 'Medium',
        'location' => $shelter,
        'is_available' => true,
        'description' => 'Lovely pet',
        'image' => 'pets/default.jpg'
    ]);
}

// Create some adopted pets
for ($i = 1; $i <= 5; $i++) {
    App\Models\Pet::create([
        'name' => 'Adopted Pet ' . $i,
        'type' => 'Dog',
        'breed' => 'Mixed',
        'age' => 'Adult',
        'gender' => 'Male',
        'size' => 'Medium',
        'location' => $shelter,
        'is_available' => false,
        'description' => 'Happy adopted pet',
        'image' => 'pets/default.jpg'
    ]);
}
```

### Step 3: Create Adoption Applications
```php
$pet = App\Models\Pet::where('location', $shelter)->where('is_available', true)->first();

App\Models\AdoptionApplication::create([
    'pet_id' => $pet->id,
    'answers' => [
        'firstName' => 'John',
        'lastName' => 'Doe',
        'email' => 'john@example.com',
        'phone' => '555-1234'
    ],
    'status' => 'pending'
]);

// Create approved application
$pet2 = App\Models\Pet::where('location', $shelter)->where('is_available', true)->skip(1)->first();
App\Models\AdoptionApplication::create([
    'pet_id' => $pet2->id,
    'answers' => [
        'firstName' => 'Jane',
        'lastName' => 'Smith',
        'email' => 'jane@example.com',
        'phone' => '555-5678'
    ],
    'status' => 'approved'
]);
```

### Step 4: Visit Analytics Page
Navigate to: http://localhost:8000/admin/shelter/analytics

## Expected Results

### With Test Data

**Current Capacity Card**:
- Shows: "10 / 30" (if Manila Shelter)
- Progress bar: ~33% (green - Normal)
- Breakdown: Dogs: X, Cats: Y

**At-Risk Pets Card**:
- Shows: Number of pets with 7+ days
- Lists: Oldest pet name and days

**Average Length of Stay**:
- Shows: Average days (calculated from created_at)
- Breakdown by dogs/cats

**Lives Saved**:
- Shows: 5 (number of adopted pets)
- Applications: 2 approved

**Pet Status Distribution**:
- Available: 10
- On Hold: 1
- Adopted: 5

**Application Status**:
- Pending: 1
- Approved: 1
- Rejected: 0

**Adoption Rate**:
- Shows: ~33% (5 adopted / 15 total)
- Circular progress visualization

**Charts**:
- Correlation: Scatter plot with data points
- Length of Stay: Bar chart showing distribution

### Without Test Data

All metrics will show:
- 0 for counts
- N/A for averages
- Empty charts
- This is **correct behavior** - not an error!

## Verifying Location Filtering

### Test 1: Create Pets in Different Locations
```php
// Create pets for Manila
App\Models\Pet::factory()->count(5)->create(['location' => 'Manila Shelter']);

// Create pets for Quezon City
App\Models\Pet::factory()->count(10)->create(['location' => 'Quezon City Shelter']);

// Login as Manila admin
$manila_admin = App\Models\User::find(1);
$manila_admin->shelter_location = 'Manila Shelter';
$manila_admin->save();
```

**Expected**: Analytics shows only 5 pets (Manila location)

### Test 2: Switch Location
```php
// Change to Quezon City
$manila_admin->shelter_location = 'Quezon City Shelter';
$manila_admin->save();
```

**Expected**: Analytics now shows 10 pets (Quezon City location)

## Testing Specific Features

### Capacity Thresholds
```php
$shelter = 'Manila Shelter'; // Max capacity: 30

// Test Normal (< 60%)
Pet::factory()->count(15)->create(['location' => $shelter, 'is_available' => true]);
// Expected: Green badge "Normal"

// Test High (60-85%)
Pet::factory()->count(20)->create(['location' => $shelter, 'is_available' => true]);
// Expected: Yellow badge "High"

// Test Critical (> 85%)
Pet::factory()->count(28)->create(['location' => $shelter, 'is_available' => true]);
// Expected: Red badge "Critical"
```

### At-Risk Pets
```php
// Create old pet
App\Models\Pet::create([
    'name' => 'Old Pet',
    'type' => 'Dog',
    'breed' => 'Mixed',
    'age' => 'Senior',
    'gender' => 'Male',
    'size' => 'Medium',
    'location' => $shelter,
    'is_available' => true,
    'date_added' => now()->subDays(30),
    'description' => 'Needs home urgently',
    'image' => 'pets/default.jpg'
]);
```

**Expected**: Pet appears in at-risk list with "30d"

### Adoption Rate Calculation
```php
// Formula: (adopted / total) * 100

// Example: 10 total pets, 4 adopted
// Rate = (4 / 10) * 100 = 40%

$shelter = 'Manila Shelter';
Pet::factory()->count(6)->create(['location' => $shelter, 'is_available' => true]);
Pet::factory()->count(4)->create(['location' => $shelter, 'is_available' => false]);

// Expected: 40% adoption rate with circular progress at 40%
```

## Troubleshooting

### Issue: Page shows all zeros
**Cause**: No pets in database for your location
**Solution**: Run test data creation script above

### Issue: Charts not rendering
**Cause**: Chart.js not loaded
**Solution**: Check browser console, ensure CDN accessible

### Issue: Wrong location data showing
**Cause**: shelter_location not set or incorrect
**Solution**: Verify with `$user->shelter_location` in tinker

### Issue: Applications not counted
**Cause**: Applications not linked to pets in your location
**Solution**: Ensure application's pet_id belongs to your shelter

## Quick Test Commands

```bash
# Check user's location
docker exec pawpal_app php artisan tinker
App\Models\User::find(1)->shelter_location;

# Count pets by location
App\Models\Pet::where('location', 'Manila Shelter')->count();

# Count available pets
App\Models\Pet::where('location', 'Manila Shelter')->where('is_available', true)->count();

# Count adopted pets
App\Models\Pet::where('location', 'Manila Shelter')->where('is_available', false)->count();

# Count applications for location
App\Models\AdoptionApplication::whereHas('pet', function($q) {
    $q->where('location', 'Manila Shelter');
})->count();
```

## Sample Data Script

Complete script to populate analytics with realistic data:

```php
// Run in tinker
$shelter = 'Manila Shelter';

// Create 20 available pets (mix of dogs and cats)
for ($i = 1; $i <= 20; $i++) {
    App\Models\Pet::create([
        'name' => 'Pet #' . $i,
        'type' => $i % 3 == 0 ? 'Cat' : 'Dog',
        'breed' => 'Mixed Breed',
        'age' => ['Puppy', 'Young', 'Adult', 'Senior'][array_rand(['Puppy', 'Young', 'Adult', 'Senior'])],
        'gender' => $i % 2 == 0 ? 'Male' : 'Female',
        'size' => ['Small', 'Medium', 'Large'][array_rand(['Small', 'Medium', 'Large'])],
        'location' => $shelter,
        'is_available' => true,
        'description' => 'Lovely pet looking for home',
        'image' => 'pets/default.jpg',
        'date_added' => now()->subDays(rand(1, 60))
    ]);
}

// Create 10 adopted pets
for ($i = 1; $i <= 10; $i++) {
    App\Models\Pet::create([
        'name' => 'Adopted #' . $i,
        'type' => $i % 2 == 0 ? 'Cat' : 'Dog',
        'breed' => 'Mixed Breed',
        'age' => 'Adult',
        'gender' => $i % 2 == 0 ? 'Male' : 'Female',
        'size' => 'Medium',
        'location' => $shelter,
        'is_available' => false,
        'description' => 'Happy in new home',
        'image' => 'pets/default.jpg'
    ]);
}

// Create applications
$availablePets = App\Models\Pet::where('location', $shelter)->where('is_available', true)->take(5)->get();
foreach ($availablePets as $index => $pet) {
    $status = ['pending', 'approved', 'rejected'][array_rand(['pending', 'approved', 'rejected'])];
    App\Models\AdoptionApplication::create([
        'pet_id' => $pet->id,
        'answers' => [
            'firstName' => 'Applicant',
            'lastName' => '#' . ($index + 1),
            'email' => 'applicant' . ($index + 1) . '@test.com',
            'phone' => '555-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT)
        ],
        'status' => $status
    ]);
}

echo "Sample data created successfully!\n";
echo "Available pets: 20\n";
echo "Adopted pets: 10\n";
echo "Applications: 5\n";
```

## Success Indicators

When everything is working correctly:

✅ **Capacity Card**: Shows real count with colored badge
✅ **At-Risk Card**: Lists pets with 7+ days
✅ **Avg Length**: Shows calculated days
✅ **Lives Saved**: Counts adopted pets
✅ **Status Distribution**: Shows 3 categories with counts
✅ **Application Status**: Shows 3 statuses with counts
✅ **Adoption Rate**: Circular progress with percentage
✅ **Charts**: Both charts render with data
✅ **Location Filter**: Only your shelter's data shows

## Performance Check

The page should load in < 2 seconds with:
- 50 pets
- 20 applications
- All queries optimized
- No N+1 issues

If slower, check:
- Database indexes on `location`, `is_available`, `status`
- Query optimization in controller
- Consider caching for high traffic
