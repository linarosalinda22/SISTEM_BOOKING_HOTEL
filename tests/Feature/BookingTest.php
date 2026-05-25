<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Tamus;
use App\Models\TipeKamar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test data
        $tipeKamar = TipeKamar::factory()->create();
        Kamar::factory()->create([
            'tipe_kamar_id' => $tipeKamar->id,
            'status_kamar' => 'Tersedia'
        ]);
        Tamus::factory()->create();
    }

    /**
     * Test viewing booking list
     */
    public function test_can_view_booking_list(): void
    {
        Booking::factory()->create();

        $response = $this->get('/booking');

        $response->assertStatus(200);
        $response->assertViewIs('booking.index');
    }

    /**
     * Test viewing create booking form
     */
    public function test_can_view_create_booking_form(): void
    {
        $response = $this->get('/booking/create');

        $response->assertStatus(200);
        $response->assertViewIs('booking.create');
    }

    /**
     * Test creating new booking
     */
    public function test_can_create_new_booking(): void
    {
        $tamu = Tamus::first();
        $kamar = Kamar::first();

        $response = $this->post('/booking', [
            'tamu_id' => $tamu->id,
            'kamar_id' => $kamar->id,
            'tanggal_checkin' => '2026-06-01',
            'tanggal_checkout' => '2026-06-05',
        ]);

        $response->assertRedirect('/booking');
        $this->assertDatabaseHas('booking', [
            'tamu_id' => $tamu->id,
            'kamar_id' => $kamar->id,
        ]);
    }

    /**
     * Test validation on create booking
     */
    public function test_validation_on_create_booking(): void
    {
        $response = $this->post('/booking', [
            'tamu_id' => '',
            'kamar_id' => '',
            'tanggal_checkin' => '',
            'tanggal_checkout' => '',
        ]);

        $response->assertSessionHasErrors(['tamu_id', 'kamar_id', 'tanggal_checkin', 'tanggal_checkout']);
    }

    /**
     * Test viewing booking detail
     */
    public function test_can_view_booking_detail(): void
    {
        $booking = Booking::factory()->create();

        $response = $this->get("/booking/{$booking->id}");

        $response->assertStatus(200);
        $response->assertViewIs('booking.show');
    }

    /**
     * Test viewing edit booking form
     */
    public function test_can_view_edit_booking_form(): void
    {
        $booking = Booking::factory()->create(['status_booking' => 'Pending']);

        $response = $this->get("/booking/{$booking->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('booking.edit');
    }

    /**
     * Test updating booking
     */
    public function test_can_update_pending_booking(): void
    {
        $booking = Booking::factory()->create(['status_booking' => 'Pending']);
        $newTamu = Tamus::factory()->create();

        $response = $this->put("/booking/{$booking->id}", [
            'tamu_id' => $newTamu->id,
            'kamar_id' => $booking->kamar_id,
            'tanggal_checkin' => '2026-06-10',
            'tanggal_checkout' => '2026-06-15',
        ]);

        $response->assertRedirect('/booking');
        $this->assertDatabaseHas('booking', [
            'id' => $booking->id,
            'tamu_id' => $newTamu->id,
        ]);
    }

    /**
     * Test cannot update non-pending booking
     */
    public function test_cannot_update_non_pending_booking(): void
    {
        $booking = Booking::factory()->create(['status_booking' => 'Check-in']);

        $response = $this->put("/booking/{$booking->id}", [
            'tamu_id' => $booking->tamu_id,
            'kamar_id' => $booking->kamar_id,
            'tanggal_checkin' => '2026-06-10',
            'tanggal_checkout' => '2026-06-15',
        ]);

        $response->assertSessionHasErrors();
    }

    /**
     * Test deleting pending booking
     */
    public function test_can_delete_pending_booking(): void
    {
        $booking = Booking::factory()->create(['status_booking' => 'Pending']);

        $response = $this->delete("/booking/{$booking->id}");

        $response->assertRedirect('/booking');
        $this->assertDatabaseMissing('booking', ['id' => $booking->id]);
    }

    /**
     * Test cannot delete non-pending booking
     */
    public function test_cannot_delete_non_pending_booking(): void
    {
        $booking = Booking::factory()->create(['status_booking' => 'Check-in']);

        $response = $this->delete("/booking/{$booking->id}");

        $response->assertSessionHasErrors();
        $this->assertDatabaseHas('booking', ['id' => $booking->id]);
    }

    /**
     * Test check-in booking
     */
    public function test_can_check_in_pending_booking(): void
    {
        $booking = Booking::factory()->create(['status_booking' => 'Pending']);

        $response = $this->post("/booking/{$booking->id}/check-in");

        $response->assertRedirect('/booking');
        $this->assertDatabaseHas('booking', [
            'id' => $booking->id,
            'status_booking' => 'Check-in',
        ]);
    }

    /**
     * Test check-out booking
     */
    public function test_can_check_out_checkin_booking(): void
    {
        $booking = Booking::factory()->create(['status_booking' => 'Check-in']);

        $response = $this->post("/booking/{$booking->id}/check-out");

        $response->assertRedirect('/booking');
        $this->assertDatabaseHas('booking', [
            'id' => $booking->id,
            'status_booking' => 'Selesai',
        ]);
    }

    /**
     * Test search booking by guest name
     */
    public function test_can_search_booking_by_guest_name(): void
    {
        $tamu = Tamus::factory()->create(['nama_lengkap' => 'John Doe']);
        Booking::factory()->create(['tamu_id' => $tamu->id]);

        $response = $this->get('/booking?search=John');

        $response->assertStatus(200);
    }

    /**
     * Test filter booking by status
     */
    public function test_can_filter_booking_by_status(): void
    {
        Booking::factory()->create(['status_booking' => 'Pending']);
        Booking::factory()->create(['status_booking' => 'Check-in']);

        $response = $this->get('/booking?status=Pending');

        $response->assertStatus(200);
    }
}
